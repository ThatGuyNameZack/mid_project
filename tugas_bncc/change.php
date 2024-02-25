<?php
// Connect
require 'functions.php';

// Take data from the URL
$id = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : null;

// Query data
$atd = query("SELECT * FROM attendance WHERE id = $id")[0];

// Check if form is submitted
if (isset($_POST["Change"])) {
    // Assuming you have a function named Change in functions.php
    if (Change($_POST) > 0) {
        echo "
            <script>
            alert('Data successfully changed');
            document.location.href = 'index.php';
            </script>
        ";
    } else {
        echo "
            <script>
            alert('Failed to change data');
            document.location.href = 'index.php';
            </script>
        ";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Data</title>
</head>
<body>
    <h1>Change students data</h1>
    <link rel="stylesheet" href="change.css">


    <form action="" method="post" enctype=:"multipart/form-data">
        <input type="hidden" name="id" value="<?= $atd["id"]; ?>">
        <input type="hidden" name="oldPicture" value="<?= $atd["ProfilePic"]; ?>">
        <ul>
            

        
            <li>
                <label for="firstName">First Name:</label>
                <input type="text" name="firstName" id="firstName" required value="<?= $atd["firstName"]; ?>">
            </li>

            <li>
                <label for="lastName">Last Name:</label>
                <input type="text" name="lastName" id="lastName" required value="<?= $atd["lastName"]; ?>">
            </li>

            <li>
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" required value="<?= $atd["email"]; ?>">
            </li>

            <li>
                <label for="password">Password:</label>
                <input type="text" name="password" id="password" required value="<?= $atd["password"]; ?>">
            </li>

            <li>
                <label for="bio">Bio:</label>
                <input type="text" name="bio" id="bio" required value="<?= $atd["bio"]; ?>">
            </li>

            <li>
                <button type="submit" name="Change">Change</button>
            </li>
        </ul>
    </form>
</body>
</html>
