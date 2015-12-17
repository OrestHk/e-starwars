<?php

use Illuminate\Database\Seeder;

use App\Tag;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Product::class, 20)
            ->create()
            ->each(function($product){
                // Get tags list
                $tags = Tag::lists('id');
                foreach($tags as $tag){
                    // Randomly attach a tag to a post
                    if(rand(0, 1)){
                        $product->tags()->attach($tag, [
                            'created_at'    => Carbon\Carbon::now(),
                            'updated_at'    => Carbon\Carbon::now()
                        ]);
                    }
                }
            });
    }
}
