<?php

namespace App\Http\Controllers;

use App\History;
use App\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\Category;
use App\Tag;
use Cookie;
use View;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    private $paginat = 10;

    public function __construct(Request $request){
        parent::__construct();

        // Check for splash cookie
        if($request->cookie('splash'))
            $splash = false;
        else{
            // Set cookie
            Cookie::queue('splash', true, 43200);
            $splash = true;
        }
        // Tell if splash screen is needed
        View::composer('front.layouts.master', function ($view) use ($splash){
            $view->with('splash', $splash);
        });
    }

    /**
     * Display home products
     */
    public function home(){
        $class = 'home';
        $products = Product::where('status', 'published')
            ->with('tags', 'category', 'picture')
            ->orderBy('publish_date', 'DESC')
            ->take(10)
            ->get();
        $prods = $this->splitProducts($products);
        return view('front.home', compact('prods', 'class'));
    }
    /**
     * Display all products
     */
    public function products(){
        $class = 'products';
        $products = Product::where('status', 'published')
            ->with('tags', 'category', 'picture')
            ->orderBy('publish_date', 'DESC')
            ->paginate($this->paginat);
        $prods = $this->splitProducts($products);
        return view('front.products.index', compact('prods', 'products', 'class'));
    }
    /**
     * Get product info by slug
     */
    public function singleProduct($slug){
        $class = 'product';
        $product = Product::where('slug', $slug)
            ->with('tags', 'category', 'picture')
            ->firstOrFail();
        return view('front.products.single', compact('product', 'class'));
    }
    /**
     * Get products relative to category
     */
    public function categoryProducts($slug){
        $class = 'category';
        $category = Category::where('slug', $slug)
            ->firstOrFail();
        $products = Product::where('category_id', $category->id)
            ->orderBy('publish_date', 'DESC')
            ->with('tags', 'picture')
            ->paginate($this->paginat);
        $prods = $this->splitProducts($products);
        return view('front.categories.single', compact('category', 'prods', 'products', 'class'));
    }
    /**
     * Get products relative to tags
     */
    public function tagProducts($slug){
        $class = 'tag';
        $tag = Tag::where('slug', $slug)
            ->firstOrFail();
        $products = $tag->products()
            ->orderBy('publish_date', 'DESC')
            ->with('tags', 'category', 'picture')
            ->paginate($this->paginat);
        $prods = $this->splitProducts($products);
        return view('front.tags.single', compact('tag', 'prods', 'products', 'class'));
    }
    /**
     * Split products in two columns
     */
    private function splitProducts($products){
        $index = 0;
        $prodLeft = array();
        $prodRight = array();
        foreach($products as $product){
            if($index % 2 == 0)
                array_push($prodLeft, $product);
            else
                array_push($prodRight, $product);
            $index++;
        }
        $products = [
            'left' => $prodLeft,
            'right' => $prodRight
        ];

        return $products;
    }

    public function order(){
        $orders = json_decode($_COOKIE['SwC']);
        $products_ids = [];
        $cost = 0;
        foreach ($orders as $order => $qtn) {
            array_push($products_ids,$order);
        }

        $products = Product::whereIn('id',$products_ids)->with('tags','category','picture')->get();

        foreach($products as $product){
            $product->final_price = $product->price * $qtn;
            $cost += $product->final_price;
        }

        setcookie('SwCcostFinal',$cost);
        return view('front.order.index',compact('products','cost'));
    }

    public function getOrderProduct(Request $request){
        $rq = $request->all();
        $products = Product::whereIn('id',$rq['ids'])->with('tags','category','picture')->get();
        return json_encode($products);
    }

    public function validationOrder(Request $request){

        $rq = $request->all();
        $orders = json_decode($_COOKIE['SwC']);
        $user = User::where('email',$rq['email'])->firstOrFail();
        if(!empty($user)){
            $history = History::create([
                'user_id'=>$user->id,
                'order_date'=>date('Y-m-d H:m:s',time()),
                'total_price'=>$_COOKIE['SwCcostFinal']
            ]);
            foreach($orders as $product_id => $quantity){
                $history->products()->attach([$history->id=>['quantity'=>$quantity,'product_id'=>$product_id]]);
            }
            setcookie('SwCcostFinal','off',time()-1);
            return 1;
        }else{
            return 0;
        }
    }

}
