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
           
            <a href="?page=home">Home</a>
            <a href="?page=Action_figure">Action Figure</a>
            <a href="?page=entry">Entry</a>
             <a href="?page=haha">Delete</a>
             <a href="?page=Edit">Edit</a>
             <a href="?page=List">List</a>
            <a href="index.php?page=login">Log out</a>
           

        </div>
		</div>

        <?php 
        switch ($pg) {
            case "luffy":
                include "mtrio.php";
                break;
                case "home":
                    include "home.php";
                    break;
                    case "Action_figure":
                        include "Action_figure.php";
                        break;
            
                case "haha":
                    include "delete.php";
                    break;
            case "login":
                include "login.php";
                break;
            case "entry":
                include "entry.php";
                break;
            case "Delete":
                include "entry_delete.php";
                break;
                case "List":
                    include "list.php";
                    break;
                case "Edit":
                    include "edit.php";
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
