<?php

    /**
     * Config project class
     */
    class Config{
        private $connection;
        private $server;
        private $user;
        private $pass;
        private $db;

        /**
         * Set vars to create project DB
         */
        function __construct($server, $user, $pass, $db){
            $this->server = $server;
            $this->user = $user;
            $this->pass = $pass;
            $this->db = $db;
            $this->setDb();
        }

        /**
         * Create database
         */
        private function setDb(){
            try{
                $this->connection = new PDO('mysql:host='.$this->server, $this->user, $this->pass);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $this->connection->exec('DROP DATABASE IF EXISTS '.$this->db);
                $this->connection->exec('CREATE DATABASE '.$this->db);

                echo "\nDatabase $this->db has been successfully created\n\n";
            } catch(PDOException $e){
              echo $e->getMessage();
            }

            $this->installVendors();
        }

        /**
         * Install vendors required for the project
         */
        private function installVendors(){
            echo "Vendors installation...\n\n";

            exec('composer install');

            echo "Node modules installation...\n\n";

            exec('npm install');

            $this->initEnv();
        }

        /**
         * Configure .env file
         */
        private function initEnv(){
            echo "Configuring .env...\n\n";

            // Get content .env.example
            $file = "/.env.example";
    		$path = getcwd();
            $content = '';
    		$example = fopen($path.$file, 'r+');
            if($example){
                while (($line = fgets($example)) !== false){
                    $expl = explode("=", $line);
                    if(isset($expl[0])){
                        $key = $expl[0];
                        if(isset($expl[1])){
                            switch($key){
                                case "DB_HOST" :
                                    $line = $key."=".$this->server."\n";
                                break;
                                case "DB_DATABASE" :
                                    $line = $key."=".$this->db."\n";
                                break;
                                case "DB_USERNAME":
                                    $line = $key."=".$this->user."\n";
                                break;
                                case "DB_PASSWORD" :
                                    $line = $key."=".$this->pass."\n";
                                break;
                            }
                        }
                    }
                    $content .= $line;
                }
            }
            fclose($example);

            // Create .env
            $env = $path.'/.env';
            file_put_contents($env, $content);

            $this->runArtisan();
        }

        /**
         * Create db tables and datas
         */
        private function runArtisan(){
            echo "Generating a key...\n\n";

            exec('php artisan key:generate');

            echo "Artisan working...\n\n";

            exec('php artisan migrate --seed');

            echo "Project ready !\n";
        }
    }
