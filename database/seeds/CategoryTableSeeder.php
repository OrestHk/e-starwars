<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([[
            'name'          => 'Helmets',
            'slug'          => 'helmets',
            'description'   => 'A set of various helmets suiting the most badass dark Lords',
            'created_at'    => Carbon\Carbon::now(),
            'updated_at'    => Carbon\Carbon::now()
        ],[
            'name'          => 'Lasers',
            'slug'          => 'lasers',
            'description'   => 'Weapons, weapons, LASER WEAPONS !',
            'created_at'    => Carbon\Carbon::now(),
            'updated_at'    => Carbon\Carbon::now()
        ]]);
    }
}
