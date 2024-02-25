<?php
require 'functions.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session
session_start();

// Check if the user is already logged in
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: index.php");
    exit;
}

// Check if the "Remember Me" checkbox is checked
$rememberMe = isset($_POST['remember']) ? true : false;


$conn = mysqli_connect("localhost", "root", "", "attendancephp");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username ='$username'";
    $result = mysqli_query($conn, $query);

    // Check if username exists
    if ($result && mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);

        // Check password if it exist
        if (password_verify($password, $row["password"])) {
            // Store user information in session
            $_SESSION["user_id"] = $row["user_id"];
            $_SESSION["username"] = $row["username"];
            $_SESSION["login"] = true;


            if ($rememberMe) {
                $token = bin2hex(random_bytes(32)); // Generate a random token so it wil be safer
                $cookieValue = $row["user_id"] . ':' . $token;
                $hashedCookieValue = password_hash($cookieValue, PASSWORD_BCRYPT);
                setcookie('remember_me', $hashedCookieValue, time() + (15 * 60)); // 15 minutes timer of the cookie
            }

            header("Location: index.php");
            exit;
        } else {
            echo "Invalid password";
        }
    } else {
        echo "Invalid username";
    }
}

// Close the database connection when done
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Attendance</title>
    <link rel="stylesheet" href="styles.css">

</head>
<body>
    <h1>Data absen</h1>

    <form action="" method="post">
        <ul>
            <li>
                <label for="username">Username :</label>
                <input type="text" name="username" id="username">
            </li>
            <li>
                <label for="password">Password :</label>
                <input type="password" name="password" id="password">
            </li>
            <li>
                <label for="remember">Remember Me :</label>
                <input type="checkbox" name="remember" id="remember">
            </li>
            <li>
                <button type="submit" name="login">Log In</button>
            </li>
            <li>
            <a href="registration.php" class="button">Register</a>
            </li>
        </ul>
    </form>
</body>
</html>
