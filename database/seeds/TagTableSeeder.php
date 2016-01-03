<?php

use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([[
            'name'          => 'Lightsabers',
            'slug'          => 'lightsabers',
            'created_at'    => Carbon\Carbon::now(),
            'updated_at'    => Carbon\Carbon::now()
        ],[
            'name'          => 'Blasters',
            'slug'          => 'blasters',
            'created_at'    => Carbon\Carbon::now(),
            'updated_at'    => Carbon\Carbon::now()
        ],[
            'name'          => 'First Order',
            'slug'          => 'first-order',
            'created_at'    => Carbon\Carbon::now(),
            'updated_at'    => Carbon\Carbon::now()
        ],[
            'name'          => 'Rebels',
            'slug'          => 'rebels',
            'created_at'    => Carbon\Carbon::now(),
            'updated_at'    => Carbon\Carbon::now()
        ],[
            'name'          => 'Jedi',
            'slug'          => 'jedi',
            'created_at'    => Carbon\Carbon::now(),
            'updated_at'    => Carbon\Carbon::now()
        ],[
            'name'          => 'Sith',
            'slug'          => 'sith',
            'created_at'    => Carbon\Carbon::now(),
            'updated_at'    => Carbon\Carbon::now()
        ]]);
    }
}
