<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Tag;
use App\Category;

class ProductController extends Controller
{
  /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function index()
      {

          $products = Product::paginate(5);
          return view('product.index', compact('products'));
      }


     /**
        * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
        */
       public function create()
       {
           $tags = Tag::all();

           $cats = $this->categoryTitleAndId();

           return view('product.create', compact('cats','tags'));
       }

       /**
        * Store a newly created resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return \Illuminate\Http\Response
        */
       public function store(Request $request)
       {

          $product = Product::create($request->all());

           if($request->file('image')){
               $this->storeImage($request->file('image'),$product->id);
           }


           foreach($request->input('tags') as $id){
               $product->tags()->attach($id);
           }

           return redirect()->to('admin/product')->with('message', trans('creation success'));
       }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit($id)
       {


           $product= Product::find($id);

           $cats = $this->categoryTitleAndId();
           $product->status == 'published' ? $published = true : $published = false;

           return view('product.edit', compact('product','cats'));
       }

       /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
       public function update( $request, $id)
       {


           $product = Product::find($id)->update($request->all());

           if($request->file('image')){
             $picture = new Picture($request->file('image'));

               $product->image->sync($picture);
           }

           foreach($request->input('tags') as $id){
               $product->tags()->sync($id);
           }

           return redirect()->to('admin/product')->with('message', 'success');
       }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function destroy($id)
       {
           Product::destroy($id);
           return redirect()->to('admin/product')->with('message', 'success delete');
       }

       private function categoryTitleAndId()
      {
          $categories = Category::all();
          $cats = [];
          foreach ($categories as $category) {
              $cats[$category->id] = $category->name;
          }
          return $cats;
      }

}
