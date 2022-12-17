<?php
    require __DIR__ . '/vendor/autoload.php';
    use Dotenv\Dotenv;
    use Firebase\JWT\JWT;


    $dotenv = Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit();
    }

        
    $jsonRequest = json_decode(file_get_contents('php://input'), true);
     
    if (!isset($jsonRequest["email"])) {
        $err = [
            "result" => "invalid request",
            "error" => "email is required"
        ];
        http_response_code(400);
        echo json_encode( $err );
        die();
    }

    $expired_time = time() + (60 * 60);

    $payload = [
        "email" => $jsonRequest["email"],
        'exp' => $expired_time
    ];

    $jwtEncode =   JWT::encode($payload,$_ENV["SECRET_KEY"],'HS256');


    $payload['exp'] = time() + (120 * 60);
    $refresh_token = JWT::encode($payload, $_ENV['REFRESH_SECRET_KEY'],'HS256');

    $result = [
        "accessToken" => $jwtEncode ,
        "refreshToken" => $refresh_token
    ];

    echo json_encode($result);

?>