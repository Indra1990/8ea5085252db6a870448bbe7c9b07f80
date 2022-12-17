<?php
    require __DIR__ . '/vendor/autoload.php';
    require __DIR__. '/validate_token.php';

    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        http_response_code(405);
         die();
    }

  $checkToken = new Auth();
  $data = $checkToken->check_token() ;


  echo json_encode( $data)  ;
?>