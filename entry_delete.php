<!doctype html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 700px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        p {
            font-size: 16px;
            margin-bottom: 10px;
        }
        input[type="text"] {
            width: 95%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 18px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .form-group {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Pirate Data Deletion</h2>
        <form method="POST" action="delete.php">
            <div class="form-group">
                <p>Delete Pirate ID: </p>
                <input type="text" name="idno" placeholder="Enter Pirate ID to delete">
            </div>
            <div class="form-group"> 
            <a href="?page=haha">a<input type="submit" value="Submit"></a>
                
            </div>
        </form>
    </div>
    

</body>
</html>
