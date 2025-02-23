<?php
require_once "connection.php";

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
} else {
   
    $sqlAdmin = "SELECT * FROM admin"; 
    $resultAdmin = $db->query($sqlAdmin);

    $sqlUser = "SELECT * FROM ordinary_users";
    $resultUser = $db->query($sqlUser);


    if ($resultAdmin->num_rows > 0 || $resultUser->num_rows > 0) {
        echo "<table class='student-table'>
                <tr>
                    <th scope='col'>ID</th>
                    <th scope='col'>Fullname</th>
                    <th scope='col'>Username</th>
                   
                </tr>";


        while ($row = $resultAdmin->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['fullname'] . "</td>
                    <td>" . $row['username'] . "</td>
                    
                  </tr>";
        }

    
        while ($row = $resultUser->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['fullname'] . "</td>
                    <td>" . $row['username'] . "</td>
                   
                  </tr>";
        }

        echo "</table>";
    } else {
        echo "No records found";
    }
}

$db->close();
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f9;
        margin: 0;
        padding: 20px;
    }

    .student-table {
        width: 80%;
        margin: 20px auto;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .student-table th, .student-table td {
        padding: 10px 15px;
        text-align: left;
    }

    .student-table th {
        background-color: rgb(255, 255, 255);
        color: black;
        font-weight: bold;
    }

    .student-table tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    .student-table tr:hover {
        background-color: #ddd;
    }

    .student-table td {
        border-bottom: 1px solid #ddd;
    }

    .student-table th, .student-table td {
        font-size: 16px;
    }

    .student-table tr:last-child td {
        border-bottom: none;
    }
</style>
