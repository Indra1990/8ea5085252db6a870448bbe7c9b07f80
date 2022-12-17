<?php
    require __DIR__ . '/vendor/autoload.php';
    require __DIR__. '/config.php';


    $config = new Config();
    $redis = $config->connect_redis();
    

    $data = $redis->lpop('message');
    if (empty($data) ){
        echo "no message data ";
        die;
    }

    $decode  = json_decode($data, true);

    $pg = $config->connect_pg();

    $title = $decode['title'];
    $desc = $decode['desc'];

    $sql = "INSERT INTO message  (title,description) VALUES ('$title','$desc')";

    $insertQuery = pg_query($pg, $sql );
    if (!$insertQuery ){
        echo pg_last_error($pg);
    }

    echo "Inserted successfully"." (".$title ." and ".$desc.")";

?>
