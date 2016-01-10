<?php

use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        factory(App\Order::class, 20)
            ->create()
            //user_id is set
            ->each(function($order){
               $products = App\Product::all();

                foreach($products as $product){
                    if(rand(0,1)){
                        $qtn = rand(1,99);
                        $order->total_price += $qtn * $product->price;
                        $order->save();
                        $order->products()->attach([$order->id => ['quantity' => $qtn, 'product_id' => $product->id]]);
                    }
                }
            });
    }
}
