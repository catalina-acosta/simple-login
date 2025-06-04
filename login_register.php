<?php

session_start();
require_once 'config.php';

// Condition to handle registration
if (isset($_POST['register'])) { // checks if this field in the form exists when button clicked
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = $_POST['role'];

    $checkEmail = $conn->query("SELECT email FROM users WHERE email = '$email'"); // query method of the mysqli class executes a query
    if($checkEmail->num_rows > 0) {
        $_SESSION['register_error'] = 'Email is already registered!'; // SESSION: super global array in php. can be accessed across multiple pages for a user
        $_SESSION['active_form'] = 'register';
    } else {
        $conn->query("INSERT INTO users (name, email, password, role) VALUES ('$name', '$email', '$password', '$role')");
    }

    header("Location: index.php"); // redirect to home
    exit(); // stop all scripts 
}

// condition to handle login
if (isset($_POST['login'])) { // isset function listens to click of login button
    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email = '$email'"); // this variable stores the sql query that searched for the email in the db
    if ($result->num_rows > 0) { // if user found
        $user = $result->fetch_assoc(); // fetches the information associated to the user
        if (password_verify($password, $user['password'])) { // checks entered password with encrypted password in the db
            $_SESSION['name'] = $user['name']; 
            $_SESSION['email'] = $user['email'];

            // check which role is associated to user and redirects to the correct page
            if ($user['role'] === 'admin') {
                header("Location: admin_page.php");
            } else {
                header("Location: user_page.php");
            }
            exit();
        }
    }
}

$_SESSION['login_error'] = 'Incorrect email or password';
$_SESSION['active_form'] = 'login';
header("Location: index.php");

?>