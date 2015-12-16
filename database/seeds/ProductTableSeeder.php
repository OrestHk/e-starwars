<?php

use Illuminate\Database\Seeder;

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
                $faker = \Faker\Factory::create();
            });
    }
}
