<?php

namespace App\Http\Controllers;

use App\History;
use App\User;
use GuzzleHttp\Subscriber\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cookie;


use App\Product;
use App\Category;
use App\Tag;
use View;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    private $paginat = 10;

    public function __construct(){
        // Get all tags
        View::composer('front.partials.menu', function ($view){
            $view->with('allTags', Tag::all());
        });
    }
    /**
     * Display home products
     */
    public function home(){
        $products = Product::where('status', 'published')
            ->with('tags', 'category', 'picture')
            ->orderBy('publish_date', 'DESC')
            ->take(10)
            ->get();
        $prods = $this->splitProducts($products);
        return view('front.home', compact('prods'));
    }
    /**
     * Display all products
     */
    public function products(){
        $products = Product::where('status', 'published')
            ->with('tags', 'category', 'picture')
            ->orderBy('publish_date', 'DESC')
            ->paginate($this->paginat);
        $prods = $this->splitProducts($products);
        return view('front.products.index', compact('prods', 'products'));
    }
    /**
     * Get product info by slug
     */
    public function singleProduct($slug){
        $product = Product::where('slug', $slug)
            ->with('tags', 'category', 'picture')
            ->firstOrFail();
        return view('front.products.single', compact('product'));
    }
    /**
     * Get products relative to category
     */
    public function categoryProducts($slug){
        $category = Category::where('slug', $slug)
            ->firstOrFail();
        $products = Product::where('category_id', $category->id)
            ->orderBy('publish_date', 'DESC')
            ->with('tags', 'picture')
            ->paginate($this->paginat);
        $prods = $this->splitProducts($products);
        return view('front.categories.single', compact('category', 'prods', 'products'));
    }
    /**
     * Get products relative to tags
     */
    public function tagProducts($slug){
        $tag = Tag::where('slug', $slug)
            ->firstOrFail();
        $products = $tag->products()
            ->orderBy('publish_date', 'DESC')
            ->with('tags', 'category', 'picture')
            ->paginate($this->paginat);
        $prods = $this->splitProducts($products);
        return view('front.tags.single', compact('tag', 'prods', 'products'));
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

        if(!empty($_COOKIE['SwC'])){
            $products = $this->getProducts();
            $cost = $this->getCost($products);
            return view('front.order.index',compact('products','cost'));
        }else{
            return redirect('/')->with('message','No product in cart');
        }

    }

    private function getCost($products){

        $orders = json_decode($_COOKIE['SwC']);
        $products_qtn = [];
        $count = 0;
        $cost = 0;

        foreach ($orders as $order => $qtn) {
            array_push($products_qtn,$qtn);
        }

        foreach($products as $product){
            $product->final_price = $product->price * $products_qtn[$count];
            $cost += $product->final_price;
            $count++;
        }
        return $cost;
    }

    public function getProducts(){
        $orders = json_decode($_COOKIE['SwC']);
        $products_ids = [];
        foreach ($orders as $order => $qtn) {
            array_push($products_ids,$order);
        }
        $products = Product::whereIn('id',$products_ids)->with('tags','category','picture')->get();
        return $products;
    }


    public function getOrderProduct(Request $request){
        $rq = $request->all();
        $products = Product::whereIn('id',$rq['ids'])->with('tags','category','picture')->get();
        return json_encode($products);
    }

    public function validationOrder(Request $request){

        $rq = $request->all();
        $orders = json_decode($_COOKIE['SwC']);
        $products = $this->getProducts();
        $cost = $this->getCost($products);
        $user = User::where('email',$rq['email'])->firstOrFail();
        if(!empty($user)){
            $history = History::create([
                'user_id'=>$user->id,
                'order_date'=>date('Y-m-d H:m:s',time()),
                'total_price'=>$cost
            ]);
            foreach($orders as $product_id => $quantity){
                $history->products()->attach([$history->id=>['quantity'=>$quantity,'product_id'=>$product_id]]);
            }
            Cookie::queue('SwC','off',-1);
            return 1;
        }else{
            return 0;
        }
    }

}
