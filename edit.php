<?php

require_once "connection.php";

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}


$showSearchForm = true;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search'])) {
  
    $idno = $_POST['idno'];
    $idno = $db->real_escape_string($idno);

  
    $sqlAdmin = "SELECT * FROM admin WHERE id = ?";
    $stmtAdmin = $db->prepare($sqlAdmin);
    $stmtAdmin->bind_param("i", $idno);
    $stmtAdmin->execute();
    $resultAdmin = $stmtAdmin->get_result();

   
    if ($resultAdmin->num_rows > 0) {
        $user = $resultAdmin->fetch_assoc();
        $showSearchForm = false; 
        ?>
        <div class="form-container">
            <h2 style="color: orange;">Information</h2>
            <p><strong>ID:</strong> <?php echo $user['id']; ?></p>
            <p><strong>Name:</strong> <?php echo $user['fullname']; ?></p>
            <p><strong>Username:</strong> <?php echo $user['username']; ?></p>

            <h2 style="color: orange;">Edit Information</h2>
            <form method="POST">
                <input type="hidden" name="idno" value="<?php echo $user['id']; ?>">
                <label for="fullname">Full Name:</label>
                <input type="text" name="fullname" id="fullname" value="<?php echo $user['fullname']; ?>" required>
                <br>
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" value="<?php echo $user['username']; ?>" required>
                <br>
                <input type="submit" name="update" value="Update Record" class="submit-button">
            </form>
        </div>
        <?php
    } else {
        
        $sqlUser = "SELECT * FROM ordinary_users WHERE id = ?";
        $stmtUser = $db->prepare($sqlUser);
        $stmtUser->bind_param("i", $idno);
        $stmtUser->execute();
        $resultUser = $stmtUser->get_result();

       
        if ($resultUser->num_rows > 0) {
            $user = $resultUser->fetch_assoc();
            $showSearchForm = false;  
            ?>
            <div class="form-container">
            <h1 style="color: orange;">Information</h1>
                <p><strong>ID:</strong> <?php echo $user['id']; ?></p>
                <p><strong>Name:</strong> <?php echo $user['fullname']; ?></p>
                <p><strong>Username:</strong> <?php echo $user['username']; ?></p>

                <h2>Edit Ordinary User Information</h2>
                <form method="POST">
                    <input type="hidden" name="idno" value="<?php echo $user['id']; ?>">
                    <label for="fullname">Full Name:</label>
                    <input type="text" name="fullname" id="fullname" value="<?php echo $user['fullname']; ?>" required>
                    <br>
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" value="<?php echo $user['username']; ?>" required>
                    <br>
                    <input type="submit" name="update" value="Update Record" class="submit-button">
                </form>
            </div>
            <?php
        } else {
            echo "<p class='error-message'>No record found with that ID in either table.</p>";
        }
    }

   
    $stmtAdmin->close();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $idno = $_POST['idno'];
    $fullname = $_POST['fullname'];
    $username = $_POST['username'];

   
    $idno = $db->real_escape_string($idno);
    $fullname = $db->real_escape_string($fullname);
    $username = $db->real_escape_string($username);

 
    $sqlAdmin = "SELECT * FROM admin WHERE id = ?";
    $stmtAdmin = $db->prepare($sqlAdmin);
    $stmtAdmin->bind_param("i", $idno);
    $stmtAdmin->execute();
    $resultAdmin = $stmtAdmin->get_result();

    if ($resultAdmin->num_rows > 0) {
      
        $stmtUpdate = $db->prepare("UPDATE admin SET fullname = ?, username = ? WHERE id = ?");
        $stmtUpdate->bind_param("ssi", $fullname, $username, $idno);
        if ($stmtUpdate->execute()) {
            echo "<p class='success-message'>Admin record updated successfully!</p>";
        } else {
            echo "<p class='error-message'>Error updating admin record: " . $stmtUpdate->error . "</p>";
        }
        $stmtUpdate->close();
    } else {
      
        $sqlUser = "SELECT * FROM ordinary_users WHERE id = ?";
        $stmtUser = $db->prepare($sqlUser);
        $stmtUser->bind_param("i", $idno);
        $stmtUser->execute();
        $resultUser = $stmtUser->get_result();

        if ($resultUser->num_rows > 0) {
            
            $stmtUpdate = $db->prepare("UPDATE ordinary_users SET fullname = ?, username = ? WHERE id = ?");
            $stmtUpdate->bind_param("ssi", $fullname, $username, $idno);
            if ($stmtUpdate->execute()) {
                echo "<p class='success-message'>Ordinary user record updated successfully!</p>";
            } else {
                echo "<p class='error-message'>Error updating ordinary user record: " . $stmtUpdate->error . "</p>";
            }
            $stmtUpdate->close();
        } else {
            echo "<p class='error-message'>User not found in both tables</p>";
        }
    }

   
    $stmtAdmin->close();
}


$db->close();
?>


<?php if ($showSearchForm): ?>
    <div class="form-container">
        <h3 style="font-size: 25px;">Search for User</h3>
        <form method="POST">
            <label for="idno">Enter User ID:</label>
            <input type="number" name="idno" id="idno" required>
            <input type="submit" name="search" value="Search" class="submit-button">
        </form>
    </div>
<?php endif; ?>


<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .form-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 20px auto;
        padding: 20px;
        width: 60%;
        max-width: 600px;
        text-align: center;
        margin-top: 70px;
    }

    h3 {
        color: #333;
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
        display: block;
        margin-bottom: 8px;
        color: #555;
    }

    input[type="number"], input[type="text"], input[type="submit"] {
        width: 90%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 16px;
    }

    input[type="submit"] {
        background-color: orange;
        color: white;
        border: none;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    .submit-button {
        background-color: #4CAF50;
        color: white;
        font-size: 16px;
    }

    .submit-button:hover {
        background-color: #45a049;
    }

    .error-message, .success-message {
        color: white;
        padding: 10px;
        border-radius: 5px;
        text-align: center;
        margin-top: 20px;
        font-size: 16px;
        width: 80%;
        max-width: 600px;
        margin: 20px auto;
    }

    .error-message {
        background-color: #f44336; 
    }

    .success-message {
        background-color: #4CAF50; 
    }
</style>
