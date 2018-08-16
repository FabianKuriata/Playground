<?php
    $host = "localhost";
    $db_name = "php_crud_level1";
    $username = "root";
    $password = "";

    try {
        $connect = new PDO("mysql:host={$host};dbname={$db_name}", $username, $password);

    }

    catch(PDOException $exception) {
        echo "Connection error: " . $exception->getMessage();
    }
?>