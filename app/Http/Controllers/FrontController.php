<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Product;
use App\Category;
use App\Tag;

class FrontController extends Controller
{
    private $paginat = 10;
    /**
     * Display home products
     */
    public function home(){
        $products = Product::where('status', 'published')
            ->with('tags', 'category', 'picture')
            ->orderBy('publish_date', 'DESC')
            ->take(10)
            ->get();
        return view('front.home', compact('products'));
    }
    /**
     * Display all products
     */
    public function products(){
        $products = Product::where('status', 'published')
            ->with('tags', 'category', 'picture')
            ->orderBy('publish_date', 'DESC')
            ->paginate($this->paginat);
        return view('front.products.index', compact('products'));
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
        return view('front.categories.single', compact('category', 'products'));
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
        return view('front.tags.single', compact('tag', 'products'));
    }

    public function order(){
      return view('front.order.index');
    }

    public function getOrderProduct(Request $request){

        $rq = $request->all();
        $products = Product::whereIn('id',$rq['ids'])->with('tags','category','picture')->get();

        return json_encode($products);
    }

}
