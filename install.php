<?php

  $server = 'localhost';
  $user = 'root';
  $pass = '';
  $db = 'starwars';
  $connection;

  try{
    $connection = new PDO('mysql:host='.$server, $user, $pass);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $connection->exec('DROP DATABASE IF EXISTS '.$db);
    $connection->exec('CREATE DATABASE '.$db);

    echo "\nDatabase $db has been successfully created\n";
  } catch(PDOException $e){
    echo $e->getMessage();
  }

  echo "Vendors installation...\n";

  exec('composer install');

  echo "Node modules installation...\n";

  exec('npm install');

  echo "Artisan working...\n";

  exec('php artisan migrate:refresh --seed');

  echo "Project ready\n";
