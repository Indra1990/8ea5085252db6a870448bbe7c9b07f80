<?php
    require __DIR__ . '/vendor/autoload.php';
    require __DIR__. '/config.php';

    $config = new Config();
    $redis = $config->connect_redis();
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        die();
    }

    $jsonRequest = json_decode(file_get_contents('php://input'), true);
  
    $redis->rpush("message", json_encode($jsonRequest));
    echo "Message accepted successfully.\n";

?>