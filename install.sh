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

    sed -i -e "s/DB_HOST=localhost/DB_HOST=$DB_HOST/g" ./.env;
    sed -i -e "s/DB_DATABASE=homestead/DB_DATABASE=$DB_DATABASE/g" ./.env;
    sed -i -e "s/DB_USERNAME=homestead/DB_USERNAME=$USERNAME/g" ./.env;
    sed -i -e "s/DB_PASSWORD=secret/DB_PASSWORD=$PASSWORD/g" ./.env;

fi


#composer install
echo -n "Do you wish to install composer element ? (y/n)"
read answer

if [ $answer="y" ]; then

    composer install;

fi


#install dependencies node

echo -n "Do you wish to install modules node for gulp program? (y/n)"
read answer

if [ ! -d "./node_modules/" ] && [ $answer="y" ]; then

    npm install gulp -g
    npm install gulp --save-dev
    npm install gulp-autoprefixer gulp-sass gulp-minify-css gulp-concat gulp-uglify gulp-imagemin gulp-phpunit gulp-notify gulp-rename gulp-livereload --save-dev

fi

echo "install finish";