<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Tag;
use App\Category;
use App\Picture;

class ProductController extends Controller
{
  /**
       * Display a listing of the resource.
       *
       * @return \Illuminate\Http\Response
       */
      public function index()
      {

          $products = Product::with('tags','category')->paginate(5);

          return view('admin.product.index', compact('products'));
      }


     /**
        * Show the form for creating a new resource.
        *
        * @return \Illuminate\Http\Response
        */
       public function create(){
           $tags = Tag::all();

           $cats = $this->categoryTitleAndId();

           return view('admin.product.create', compact('cats','tags'));
       }

       /**
        * Store a newly created resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @return \Illuminate\Http\Response
        */
       public function store(Request $request)
       {



         $req = $request->all();
         $product = Product::create($req);


         if(\Input::hasFile('image')){

            $this->AddImage($request,$product);

         }

           if(!empty($request->input('tags'))){
             foreach($request->input('tags') as $id){
               $product->tags()->attach($id);
             }
           }

           return redirect()->to('admin/product')->with('message', trans('creation success'));
       }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit($id){

           $product = Product::find($id);
           $tags = Tag::all();
           $cats = $this->categoryTitleAndId();
           $product->status == 'published' ? $published = true : $published = false;

           return view('admin.product.edit', compact('product','cats','tags'));
       }

       /**
        * Update the specified resource in storage.
        *
        * @param  \Illuminate\Http\Request  $request
        * @param  int  $id
        * @return \Illuminate\Http\Response
        */
       public function update(Request $request, $id){

           $product = Product::find($id);

           if(\Input::hasFile('image')){
               $this->AddImage($request,$product);
           }


           if(!empty($request->input('tags'))){
            $product->tags()->sync($request->input('tags'));
           }else {
              $product->tags()->detach();
           }

           $product->update($request->all());

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
           return redirect('admin/product')->with('message', 'success delete');
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

      public function AddImage($request,$product){
        $img = $request->file('image');

        $ext = $img->getClientOriginalExtension();
        $picture = Picture::create([
          'filename'=> str_slug(str_random(rand(20, 30))).'.'.$ext,
          'size' => $img->getSize(),
          'type' => $ext
        ]);
       \Input::file('image')->move(IMG_PATH_FRONT,$picture->filename);

        $product->picture()->associate($picture->id);
        $product->save();

      }

}
