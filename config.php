<?php

    $host = "localhost";
    $user = "root";
    $password = "";
    $database = "users_db";

    // creates a new mysqli object connection using the credentials above
    $conn = new mysqli($host, $user, $password, $database);

    // handles error if connection fails.
    if ($conn->connect_error) {
        die("Connection failed: ". conn->connect_error);
    }

?>