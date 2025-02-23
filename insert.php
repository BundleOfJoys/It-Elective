<?php
require_once "connection.php";

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} else {
   
    $id = $_POST['id'];
    $fullname = $db->real_escape_string($_POST['fullname']);
    $username = $db->real_escape_string($_POST['username']);
    $password = $db->real_escape_string($_POST['password']);
    $role = $_POST['role']; 

 
    if ($role == "admin") {
        $sql = "INSERT INTO admin (id, fullname, username, password) VALUES ('$id', '$fullname', '$username', '$password')";
    } else {
        $sql = "INSERT INTO ordinary_users (id, fullname, username, password) VALUES ('$id', '$fullname', '$username', '$password')";
    }

    
    if ($db->query($sql) === TRUE) {
        echo "<div class='message success'>New record created successfully as $role.</div>";
    } else {
        echo "<div class='message error'>Error: " . $sql . "<br>" . $db->error . "</div>";
    }
}

$db->close();
?>


<style>
    .message {
        font-size: 16px;
        padding: 15px;
        margin: 20px auto;
        width: 80%;
        max-width: 600px;
        text-align: center;
        border-radius: 5px;
    }

    .success {
        background-color: #4CAF50;
        color: white;
    }

    .error {
        background-color: #f44336;
        color: white;
    }
</style>
