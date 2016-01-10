<?php

use Illuminate\Database\Seeder;

use App\Tag;
use App\Picture;
use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        // Get required datas
        $images = Picture::lists('id', 'filename')->all();
        // Shuffle images
        $imgs = [];
        foreach($images as $key => $image){
            array_push($imgs, [$key => $image]);
        }
        shuffle($imgs);
        $tags = Tag::lists('id');
        // Initiate faker
        $faker = \Faker\Factory::create();
        // Set names
        $lightsabers = ['Gralor\'s lightsaber', 'Bastila\'s', 'General Konrad', 'Emiet'];
        $blasters = ['PR-458', 'D8E9-F78', 'Ion blaster', 'Supersonic boom', 'GET-477', 'GE-18', 'Colonel-48', 'Ondor'];
        $helmets = ['Clone V15', 'Colonel V2', 'Clone V7', 'Hunter 78K', 'Clone V2', 'Bounty Hunter V0 Beta', 'Hunter V7', 'Scoot', 'Clone V45', 'Scoot 87', 'Stormtrooper A7', 'General P5K'];
        // Set counts
        $count = [
            'all' => 1,
            'saber' => 0,
            'blaster' => 0,
            'helmet' => 0
        ];
        // Create products
        foreach($imgs as $image){
            foreach($image as $key => $img){
                // If is a blaster
                $isBlaster = strrpos($key, 'b');
                $isHelmet = strrpos($key, 'c');
                if($isBlaster !== false){
                    echo 'blaster'."\n";
                    $name = $blasters[$count['blaster']];
                    $slug = str_slug($name);
                    $category = 2;
                    $count['blaster']++;
                }
                // If is an helmet
                else if($isHelmet !== false){
                    echo 'helmet'."\n";
                    $name = $helmets[$count['helmet']];
                    $slug = str_slug($name);
                    $category = 1;
                    $count['helmet']++;
                }
                // If is a lightsaber
                else{
                    echo 'saber'."\n";
                    $name = $lightsabers[$count['saber']];
                    $slug = str_slug($name);
                    $category = 2;
                    $count['saber']++;
                }
                // Other data
                $description = $faker->paragraph(5);
                $short_text = str_limit($description, 255);
                $price = rand(20, 518);
                $img = $img;

                // Insert product in db
                $product = DB::table('products')->insert([
                    'name' => $name,
                    'slug' => $slug,
                    'description' => $description,
                    'short_text' => $short_text,
                    'picture_id' => $img,
                    'price' => $price,
                    'category_id' => $category,
                    'publish_date' => Carbon\Carbon::now(),
                    'created_at' => Carbon\Carbon::now(),
                    'updated_at' => Carbon\Carbon::now()
                ]);
            }
            $count['all']++;
        }

        // Attach tags to products
        $products = Product::all();
        $tags = Tag::lists('id');
        foreach($products as $product){
            foreach($tags as $tag){
                // If light saber or blaster
                if($tag < 3){
                    // If blaster
                    if($product->picture_id < 8){
                        if($tag == 2){
                            $product->tags()->attach($tag, [
                                'created_at'    => Carbon\Carbon::now(),
                                'updated_at'    => Carbon\Carbon::now()
                            ]);
                        }
                    }
                    // If lightsaber
                    else if($product->picture_id > 19){
                        if($tag == 1){
                            $product->tags()->attach($tag, [
                                'created_at'    => Carbon\Carbon::now(),
                                'updated_at'    => Carbon\Carbon::now()
                            ]);
                        }
                    }
                }
                // Randomly attach a tag to a post
                else{
                    if(rand(0, 1)){
                        $product->tags()->attach($tag, [
                            'created_at'    => Carbon\Carbon::now(),
                            'updated_at'    => Carbon\Carbon::now()
                        ]);
                    }
                }
            }
        }
    }
}
