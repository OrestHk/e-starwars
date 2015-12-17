<?php

use Illuminate\Database\Seeder;

use App\UserMeta;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'          => 'admin',
            'email'         => 'admin@admin.com',
            'password'      => Hash::make('admin'),
            'created_at'    => Carbon\Carbon::now(),
            'updated_at'    => Carbon\Carbon::now()
        ]);
        // Create 10 random users
        factory(App\User::class, 2)
            ->create()
            ->each(function($user){
                // Create user's credit card number
                $faker = \Faker\Factory::create();
                $meta = new UserMeta;
                $meta->cb = $faker->creditCardNumber();
                $meta->created_at = Carbon\Carbon::now();
                $meta->updated_at = Carbon\Carbon::now();
                $user->metas()->save($meta);
            });
    }
}
