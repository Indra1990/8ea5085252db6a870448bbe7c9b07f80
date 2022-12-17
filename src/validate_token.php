<?php
    require __DIR__ . '/vendor/autoload.php';

    use Dotenv\Dotenv;
    use Firebase\JWT\JWT;
    use Firebase\JWT\Key;
  
    class Auth {
        public function check_token()
        {
            $dotenv = Dotenv::createImmutable(__DIR__);
            $dotenv->load();

            $headers = getallheaders();
            if (!isset($headers['Authorization'])) {
              http_response_code(401);
              $err = [
                "result" => "invalid request",
                "error" => "401 Unauthorized"
              ];
              return $err ;
            }

            $token = explode(' ', $headers['Authorization']);
            $decoded = JWT::decode($token[1],new Key($_ENV["SECRET_KEY"],'HS256'));
            

           return $decoded;
        }
    }
?>