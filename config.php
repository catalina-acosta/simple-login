<?php

    $host = "localhost";
    $user = "users_bd";
    $password = "";
    $database = "users_db";

    $conn = new mysquli($host, $user, $password, $database);

    if ($conn->connect_error) {
        die("Connection failed: ". conn->connect_error);
    }

?>