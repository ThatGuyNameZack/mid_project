<?php
require 'functions.php';

if (isset($_POST["register"])) {
    if (register($_POST) > 0) {
        echo "<script> 
                alert('New user registered successfully!');
                window.location.href = 'login.php'; // Redirect to login page
              </script>";
    } else {
        echo mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration Page</title>
    <link rel="stylesheet" href="register.css">
    <style> 
        label {
            display: block;
        }
    </style>
</head>
<body>
    <h1>Registration Page</h1>
    <form action="" method="post">
        <ul>
            <li>
                <label for="username">username:</label>
                <input type="text" name="username" id="username"> 
            </li>
            <li>
                <label for="password">password :</label>
                <input type="text" name="password" id="password">
            </li>
            <li>
                <label for="password2">password confirmation</label>
                <input type="password" name="password2" id="password2"> 
            </li>
            <li>
                <button type="submit" name="register">Register!</button>
            </li>
        </ul>
    </form>
  
    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>
