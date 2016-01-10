<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

// User factory
$factory->define(App\User::class, function (Faker\Generator $faker){
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

// Product factory
$factory->define(App\Product::class, function (Faker\Generator $faker){
  // Create title + content
  $name = $faker->unique()->word(rand(1, 3));
  $slug = str_slug($name);
  $description = $faker->paragraph(rand(1, 5));
  $short_text = str_limit($description, 255);
  $price = rand(20, 518);

  // Attach a picture
  $images = App\Picture::lists('id')->all();
  $image = $images[array_rand($images)];

  return [
      'name' => $name,
      'slug' => $slug,
      'description' => $description,
      'short_text' => $short_text,
      'picture_id' => $image,
      'price' => $price,
      'category_id' => rand(1, 2),
      'publish_date' => Carbon\Carbon::now(),
      'created_at' => Carbon\Carbon::now(),
      'updated_at' => Carbon\Carbon::now()
  ];
});

$factory->define(App\Order::class,function(Faker\Generator $faker){

    return ['user_id'=>rand(1,10),'order_date'=>Carbon\Carbon::now()];

});
// Picture factory
$factory->define(App\Picture::class, function (Faker\Generator $faker){
    // Generate random image
    $image = $faker->image();
    $infos = pathinfo($image);
    $size = filesize($image);
    // Copy it in the resources folder
    copy($image, base_path(IMG_PATH_BACK.$infos['basename']));

    return [
        'filename'    => $infos['basename'],
        'size'        => $size,
        'type'        => $infos['extension'],
        'created_at'  => Carbon\Carbon::now(),
        'updated_at'  => Carbon\Carbon::now()
    ];
});
