<?php
require_once "connection.php";
session_start();


include '../data/users.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $uname = $_POST['username'];
    $pword = $_POST['password'];
    $captcha = $_POST['captcha'];

 
    if ($captcha !== $_SESSION["code"]) {
        $_SESSION['error_msg'] = 'Invalid CAPTCHA. Please try again.';
        header("location: index.php?page=signup");
        exit();
    }


    if (array_key_exists($uname, $users) && $users[$uname] === $pword) {
        $_SESSION['login_user'] = $uname;
        $_SESSION['logged_in'] = 'yes';
        $_SESSION['error_msg'] = 'User Already Exist';
        header("location: index.php?page=signup");
        exit();
    } else {
       
        header("location: logout.php?page=luffy");
        exit();
    }
}
?>
