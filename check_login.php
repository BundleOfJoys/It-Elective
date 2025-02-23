<?php
require_once "connection.php";

session_start();


$host = '127.0.0.1';
$dbname = 'onepiece';
$username = 'root'; 
$password = ''; 


try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = trim($_POST['username']);
    $pword = trim($_POST['password']);
    $captcha = trim($_POST['captcha']);

 
    if ($captcha !== $_SESSION["code"]) {
        $_SESSION['error_msg'] = 'Invalid CAPTCHA. Please try again.';
        header("location: logout.php?page=login");
        exit();
    }

  
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = :username AND password = :password");
    $stmt->execute(['username' => $uname, 'password' => $pword]);
    $admin = $stmt->fetch();

    if ($admin) {
        $_SESSION['login_user'] = $uname;
        $_SESSION['logged_in'] = 'yes';
        $_SESSION['role'] = 'admin'; 
        header("location: logout.php?page=entry"); 
        exit();
    }

    
    $stmt = $conn->prepare("SELECT * FROM ordinary_users WHERE username = :username AND password = :password");
    $stmt->execute(['username' => $uname, 'password' => $pword]);
    $user = $stmt->fetch();

    if ($user) {
        $_SESSION['login_user'] = $uname;
        $_SESSION['logged_in'] = 'yes';
        $_SESSION['role'] = 'user'; 
        header("location: logout_ordinary.php?page=List"); 
        exit();
    }

    
    $_SESSION['error_msg'] = 'Invalid username or password.';
    header("location: index.php?page=login");
    exit();
}
?>
