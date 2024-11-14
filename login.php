
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-color: #f7f1e1;
        }
        .login-container {
            max-width: 800px;
            margin: 100px auto;
            padding: 30px;
            background-color: #DFF2EB;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .login-container h2 {
            margin-bottom: 20px;
            font-family: 'Arial', sans-serif;
            color: #333;
        }
        .form-label {
            font-weight: 600;
        }
        .form-control {
            border-radius: 10px;
            border: 1px solid #ccc;
        }
        .btn-custom {
            background-color: #ffc107;
            color: white;
            border-radius: 10px;
            border: none;
            padding: 10px 20px;
        }
        .btn-custom:hover {
            background-color: #e0a800;
        }
        .register-link {
            margin-top: 10px;
            display: block;
            font-size: 14px;
        }
        .register-link a {
            color: #007bff;
            text-decoration: none;
        }
        .register-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2 style="font-style:italic; font-weight:bolder">Login</h2>
        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-custom w-100">Login</button>
        </form>
        <div class="register-link">
            <span>Don't have an account? <a href="register.php">Register here</a></span>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
session_start();// Starting Session
include "db_conn.php"; // Using database connection file here

if ($_SERVER["REQUEST_METHOD"] == "POST") { // Check if form is submitted
    $username = mysqli_real_escape_string($conn,$_POST['username']); // Get the username value from the form
    $password = $_POST['password']; // Get the password value from the form

    $sql = "SELECT * FROM users_reg WHERE username = '$username'";// Query the database for user
    $result = mysqli_query($conn, $sql);// Run the query

    if (mysqli_num_rows($result) == 1){// Check if user exists
        $row = mysqli_fetch_assoc($result);// Get the data from the database
        if (password_verify($password, $row['password'])) {// Check if the password matches
            $_SESSION['username'] = $username;// Set the session variable
            header("Location: index.php");// Redirect to the home page
        } else {// If the password doesn't match
            echo "Invalid username or password";// Display an error message
        }
    } else {// If the user doesn't exist
        echo "No user found with that username";// Display an error message
    }
}

?>

