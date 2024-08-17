<?php 

    session_start();
    
    // constants for database credentials:
        define('SITEURL', 'http://localhost/hamro-khaja-ghar/');
        define('HOST','localhost');
        define('DB_NAME', 'hamro_khaja_ghar');
        define('DB_USERNAME', 'root');
        define('PASSWORD', '');


    // Datacase connection:
    $conn = mysqli_connect(HOST, DB_USERNAME, PASSWORD,DB_NAME) or die('Connection failed: ' . mysqli_connect_error());

?>