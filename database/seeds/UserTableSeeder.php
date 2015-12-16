<?php

use Illuminate\Database\Seeder;

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
        factory(App\User::class, 10)
            ->create()
            ->each(function($user){
                // Create user's credit card number
                $faker = \Faker\Factory::create();
                $userMeta = new UserMeta;
                $userMeta->cd = $faker->creditCardNumber();
                $userMeta->created_at = Carbon\Carbon::now();
                $userMeta->updated_at = Carbon\Carbon::now();
                $user->userMeta()->save($userMeta);
            });
    }
}
