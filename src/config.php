<?php
    require __DIR__ . '/vendor/autoload.php';
    use Dotenv\Dotenv;

    class Config {
        public function connect_pg()
        {
            $dotenv = Dotenv::createImmutable(__DIR__);
            $dotenv->load();

            $host        = "host=".$_ENV["POSTGRES_HOST"];
            $port        = "port=".$_ENV["POSTGRES_PORT"];
            $dbname      = "dbname=".$_ENV["POSTGRES_DB"];
            $user        = "user=".$_ENV["POSTGRES_USER"];
            $pass        = "password=".$_ENV["POSTGRES_PASSWORD"];

            $db = pg_connect( "$host $port $dbname $user $pass"  );
            if(!$db){
                echo "Error in connecting to database.";
            }

            return $db;
        }

        public function connect_redis()
        {
            $dotenv = Dotenv::createImmutable(__DIR__);
            $dotenv->load();

            $redis = new Predis\Client(array(
                    "scheme" => $_ENV["REDIS_SCHEME"],
                    "host" => $_ENV["REDIS_HOST"],
                    "port" => $_ENV["REDIS_PORT"],
                    "password" => $_ENV["REDIS_PASSWORD"],
                )
            );

            return $redis;
        }
    }
?>