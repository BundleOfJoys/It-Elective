<?php

require_once "connection.php";

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} else {
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idno = $_POST['idno'];
        $idno = $db->real_escape_string($idno);

       
        $sqlAdmin = "SELECT * FROM admin WHERE id = ?";
        $stmtAdmin = $db->prepare($sqlAdmin);
        $stmtAdmin->bind_param("i", $idno);
        $stmtAdmin->execute();
        $resultAdmin = $stmtAdmin->get_result();

     
        if ($resultAdmin->num_rows > 0) {
            $pirate = $resultAdmin->fetch_assoc();
            echo "<div class='result-container'>";
            echo "<h3>Admin Information</h3>";
            echo "<p><strong>ID:</strong> " . $pirate['id'] . "</p>";
            echo "<p><strong>Name:</strong> " . $pirate['fullname'] . "</p>";
            echo "<p><strong>Username:</strong> " . $pirate['username'] . "</p>";

            echo "<form method='POST' class='delete-form'>";
            echo "<input type='hidden' name='idno' value='$idno'>";
            echo "<input type='submit' name='delete' value='Delete Admin Record' class='delete-button'>";
            echo "</form>";

            if (isset($_POST['delete'])) {
                $deleteQuery = "DELETE FROM admin WHERE id = ?";
                $deleteStmt = $db->prepare($deleteQuery);
                $deleteStmt->bind_param("i", $idno);
                if ($deleteStmt->execute()) {
                    echo "<p class='success-message'>Admin record deleted successfully.</p>";
                } else {
                    echo "<p class='error-message'>Error deleting admin record: " . $db->error . "</p>";
                }
            }

            echo "</div>";
        } else {
      
            $sqlUser = "SELECT * FROM ordinary_users WHERE id = ?";
            $stmtUser = $db->prepare($sqlUser);
            $stmtUser->bind_param("i", $idno);
            $stmtUser->execute();
            $resultUser = $stmtUser->get_result();

        
            if ($resultUser->num_rows > 0) {
                $pirate = $resultUser->fetch_assoc();
                echo "<div class='result-container'>";
                echo "<h3>Ordinary User Information</h3>";
                echo "<p><strong>ID:</strong> " . $pirate['id'] . "</p>";
                echo "<p><strong>Name:</strong> " . $pirate['fullname'] . "</p>";
                echo "<p><strong>Username:</strong> " . $pirate['username'] . "</p>";

                echo "<form method='POST' class='delete-form'>";
                echo "<input type='hidden' name='idno' value='$idno'>";
                echo "<input type='submit' name='delete' value='Delete Ordinary User Record' class='delete-button'>";
                echo "</form>";

                if (isset($_POST['delete'])) {
                    $deleteQuery = "DELETE FROM ordinary_users WHERE id = ?";
                    $deleteStmt = $db->prepare($deleteQuery);
                    $deleteStmt->bind_param("i", $idno);
                    if ($deleteStmt->execute()) {
                        echo "<p class='success-message'>Ordinary user record deleted successfully.</p>";
                    } else {
                        echo "<p class='error-message'>Error deleting ordinary user record: " . $db->error . "</p>";
                    }
                }

                echo "</div>";
            } else {
                echo "<p class='error-message'>No record found with that ID in either table.</p>";
            }
        }

       
        $stmtAdmin->close();
      
    } else {
       
        echo "<div class='form-container'>";
        echo "<h2>Search for User to Delete</h2>";
        echo "<form method='POST'>";
        echo "<label for='idno'>Enter User ID to Delete:</label>";
        echo "<input type='number' name='idno' id='idno' required>";
        echo "<input type='submit' value='Search' class='search-button'>";
        echo "</form>";
        echo "</div>";
    }
}

$db->close();
?>


<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }
    .form-container, .result-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 20px auto;
        padding: 20px;
        width: 70%;
        max-width: 600px;
        margin-top: 70px;
    }
    h2, h3 {
        text-align: center;
        color: #333;
    }
    label {
        font-weight: bold;
        display: block;
        margin-bottom: 8px;
    }
    input[type="number"], input[type="submit"] {
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
    .delete-button {
        background-color: #f44336;
        color: white;
        cursor: pointer;
        border: none;
        padding: 12px 20px;
        border-radius: 4px;
        width: 100%;
    }
    .delete-button:hover {
        background-color: #d32f2f;
    }
    .error-message {
        color: #f44336;
        text-align: center;
        font-size: 16px;
    }
    .success-message {
        color: #4CAF50;
        text-align: center;
        font-size: 16px;
    }
    .result-container p {
        font-size: 18px;
        line-height: 1.6;
    }
</style>
