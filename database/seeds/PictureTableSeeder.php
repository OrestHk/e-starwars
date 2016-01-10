<?php

use Illuminate\Database\Seeder;

class PictureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        // Get products dir
        $images = scandir(IMG_PATH_BACK);
        // Insert each images in DB
        foreach($images as $image){
            if($image != '.' && $image != '..'){
                $image = IMG_PATH_BACK.$image;
                $infos = pathinfo($image);
                $size = filesize($image);
                DB::table('pictures')->insert([
                    'filename'      => $infos['basename'],
                    'size'          => $size,
                    'type'          => $infos['extension'],
                    'created_at'    => Carbon\Carbon::now(),
                    'updated_at'    => Carbon\Carbon::now()
                ]);
            }
        }
    }
}
