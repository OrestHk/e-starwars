<?php

namespace App\Http\Controllers;

use App\History;
use App\User;
use GuzzleHttp\Subscriber\Redirect;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\Category;
use App\Tag;
use Cookie;
use View;
use Illuminate\Pagination\Paginator;
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
        // Products query
        $products = Product::where('status', 'published')
            ->with('tags', 'category', 'picture')
            ->orderBy('publish_date', 'DESC')
            ->take(10)
            ->get();
        // Split products in two arrays
        $prods = $this->splitProducts($products);
        // Return the view
        return view('front.home', compact('prods', 'class'));
    }
    /**
     * Display all products
     */
    public function products(Request $request, $page = false){
        $class = 'products';
        $paginatUrl = '/products/';
        // Check if request coming from ajax
        $ajax = $request->ajax();
        // Check if query for specific page
        if($page){
            Paginator::currentPageResolver(function() use ($page){
                return $page;
            });
        }
        // Products query
        $products = Product::where('status', 'published')
            ->with('tags', 'category', 'picture')
            ->orderBy('publish_date', 'DESC')
            ->paginate($this->paginat);
        // Split products in two arrays
        $prods = $this->splitProducts($products);

        // Return view for ajax call
        if($page && $ajax)
            return $this->splitProductsView($prods);
        // Return view for default display
        else
            return view('front.products.index', compact('prods', 'products', 'class', 'paginatUrl', 'page'));
    }
    /**
     * Get product info by slug
     */
    public function singleProduct($slug){
        $class = 'product';
        // Products query
        $product = Product::where('slug', $slug)
            ->with('tags', 'category', 'picture')
            ->firstOrFail();
        // Return the view
        return view('front.products.single', compact('product', 'class'));
    }
    /**
     * Get products relative to category
     */
    public function categoryProducts(Request $request, $slug, $page = false){
        $class = 'category';
        $paginatUrl = '/category/'.$slug.'/';
        // Check if request coming from ajax
        $ajax = $request->ajax();
        // Category query
        $category = Category::where('slug', $slug)
            ->firstOrFail();
        // Check if query for specific page
        if($page){
            Paginator::currentPageResolver(function() use ($page){
                return $page;
            });
        }
        // Products query
        $products = Product::where('category_id', $category->id)
            ->orderBy('publish_date', 'DESC')
            ->with('tags', 'picture')
            ->paginate($this->paginat);
        // Split products in two arrays
        $prods = $this->splitProducts($products);

        // Return view for ajax call
        if($page && $ajax)
            return $this->splitProductsView($prods);
        // Return view for default display
        else
            return view('front.categories.single', compact('category', 'prods', 'products', 'class', 'paginatUrl', 'page'));
    }
    /**
     * Get products relative to tags
     */
    public function tagProducts(Request $request, $slug, $page = false){
        $class = 'tag';
        $paginatUrl = '/tag/'.$slug.'/';
        // Check if request coming from ajax
        $ajax = $request->ajax();
        // Tag query
        $tag = Tag::where('slug', $slug)
            ->firstOrFail();
        // Check if query for specific page
        if($page){
            Paginator::currentPageResolver(function() use ($page){
                return $page;
            });
        }
        // Products query
        $products = $tag->products()
            ->orderBy('publish_date', 'DESC')
            ->with('tags', 'category', 'picture')
            ->paginate($this->paginat);
        // Split products in two arrays
        $prods = $this->splitProducts($products);

        // Return view for ajax call
        if($page && $ajax)
            return $this->splitProductsView($prods);
        // Return view for default display
        else
            return view('front.tags.single', compact('tag', 'prods', 'products', 'class', 'paginatUrl', 'page'));
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
    /**
     * Return splitted products rendered view
     */
    private function splitProductsView($prods){
        $data = [];
        // Left
        $products = $prods['left'];
        $data['left'] = view('front.ajax.products', compact('products'))->render();
        // Right
        $products = $prods['right'];
        $data['right'] = view('front.ajax.products', compact('products'))->render();
        if(!$data['left'] || !$data['right'])
            return 'last';
        return $data;
    }

    public function order(){
        $class = 'order';
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
