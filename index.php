<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body style="background-color: black;">

    <div class="column2"> 
        <?php include "header.php"; ?>
    </div>

    <div class="column">
        <?php
        $pg = isset($_GET['page']) ? $_GET['page'] : 'default';
        ?>    
		<div class="column-links">
        <div class="links-container" >
           
           
            <a href="?page=signup">Sign up</a>
            <a href="?page=login">Login</a>
		

        </div>
		</div>

        <?php 
        switch ($pg) {
            case "luffy":
                include "mtrio.php";
                break;
            case "login":
                include "login.php";
                break;
            case "signup":
                include "signup.php";
                break;
			
            default:
                include "login.php";
                break;
        }
        ?>
    </div>

    <div class="column2-footer">
        <?php include "footer.php"; ?>
    </div>

</body>
</html>
