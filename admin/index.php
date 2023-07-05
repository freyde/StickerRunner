<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        
        .container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            background-color: #f9f9f9;
        }
        
        h2 {
            text-align: center;
        }
        
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        
        button {
            background-color: purple;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
        }
        
        .error-message {
            color: red;
            font-weight: bold;
            text-align: center;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        
        <?php
        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Retrieve user input
            $username = $_POST["username"];
            $password = $_POST["password"];
            
            // Database credentials
            $host = "localhost";
            $dbUsername = "root";
            $dbPassword = "";
            $dbName = "stickerrunner";
            
            // Create a database connection
            $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
            
            // Check if connection was successful
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            // Query the user_admin table to check if username and password match
            $sql = "SELECT * FROM user_admin WHERE username = '$username' AND password = '$password'";
            $result = $conn->query($sql);
            
            // Check if any row is returned
            if ($result->num_rows > 0) {
                 header("Location: dashboard.php");
            } else {
                echo "<div class='error-message'>Invalid username or password</div>";
            }
            
            // Close the database connection
            $conn->close();
        }
        ?>
        
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>
            
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" required>
            
            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
