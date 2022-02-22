<?php
    // start sesson
    session_start();


    //Create constant store non repeting values
    define('SITEURL', 'http://localhost/FOOD-ORDER');
    define('LOCALHOST', 'localhost');
    define('BD_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'food_delevery');

    $conn = mysqli_connect(LOCALHOST, BD_USERNAME, DB_PASSWORD) or die (mysqli_error($conn)); //database connection

    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn)); //select database

?>