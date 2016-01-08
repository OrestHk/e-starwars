#!/usr/bin/env bash

echo "install e-Star-Wars Start"


#get variable for install

echo "enter DB_HOST :"
read DB_HOST
echo "enter DB_DATABASE :"
read DB_DATABASE
echo "enter DB_USERNAME :"
read USERNAME
echo "enter DBPASSWORD :"
read PASSWORD


#create database

echo -n "Do you wish to create database? (y/n)"
read answer

if [ $answer="y" ]; then

    MySQL=$(cat <<EOF
        DROP DATABASE IF EXISTS $DB_DATABASE;
        CREATE DATABASE $DB_DATABASE DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
        DELETE FROM mysql.user WHERE user='$USERNAME' and host='$PASSWORD';
        GRANT ALL PRIVILEGES ON $DB_DATABASE.* to '$USERNAME'@'$HOST' IDENTIFIED BY '$PASSWORD' WITH GRANT OPTION;
    EOF
    )

fi


#edit .env

echo -n "Do you wish to edit .env? (y/n)"
read answer

if [ $answer="y" ]; then

    sed -i -e "s/DB_HOST=localhost/DB_HOST=$DB_HOST/g" ./.env.example;
    sed -i -e "s/DB_DATABASE=homestead/DB_DATABASE=$DB_DATABASE/g" ./.env.example;
    sed -i -e "s/DB_USERNAME=homestead/DB_USERNAME=$USERNAME/g" ./.env.example;
    sed -i -e "s/DB_PASSWORD=secret/DB_PASSWORD=$PASSWORD/g" ./.env.example;

    mv .env.example .env
    php artisan key:generate
fi


#composer install
echo -n "Do you wish to install composer element ? (y/n)"
read answer

if [ $answer="y" ]; then

    composer install;

fi


#seed Db
echo -n "Do you wish to create tables and seed db ? (y/n)"
read answer

if [ $answer="y" ]; then

    php artisan migrate --seed;

fi


#install dependencies node

echo -n "Do you wish to install modules node for gulp program? (y/n)"
read answer

if [ ! -d "./node_modules/" ] && [ $answer="y" ]; then

    npm install

fi

echo "install finish";
