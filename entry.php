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
        select {
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
            background-color: orange;
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
        .response-message {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 style="color: orange;">User Data Entry</h2>
        <form id="userForm" method="POST">
            <div class="form-group">
                <p>User ID: </p>
                <input type="text" name="id" placeholder="Enter User ID" required>
            </div>
            <div class="form-group">
                <p>Full Name:</p>
                <input type="text" name="fullname" placeholder="Enter Full Name" required>
            </div>
            <div class="form-group">
                <p>Username:</p>
                <input type="text" name="username" placeholder="Enter Username" required>
            </div>
            <div class="form-group">
                <p>Password:</p>
                <input type="text" name="password" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <p>Role:</p>
                <select name="role" required>
                    <option value="admin">Admin</option>
                    <option value="ordinary_user">Ordinary User</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Submit">
            </div>
        </form>

        <div class="response-message" id="responseMessage"></div>
    </div>

    <script>
        document.getElementById('userForm').addEventListener('submit', function(event) {
            event.preventDefault();  

       
            const formData = new FormData(this);

           
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'insert.php', true);

            
            xhr.onload = function() {
                if (xhr.status === 200) {
                    document.getElementById('responseMessage').textContent = "Form submitted successfully!";
                    document.getElementById('responseMessage').style.color = "green";
                } else {
                    document.getElementById('responseMessage').textContent = "There was an error submitting the form.";
                    document.getElementById('responseMessage').style.color = "red";
                }
            };

            
            xhr.send(formData);
        });
    </script>

</body>
</html>
