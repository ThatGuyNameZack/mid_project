<?php
require 'functions.php';

if (isset($_POST["Submit"])) {
    // Call the upload function to handle file upload
    $uploadResult = upload();

    if (!$uploadResult) {
        // Handle the case where file upload failed
        echo "
            <script>
            alert('Failed to upload the image');
            </script>
        ";
    } else {
        // If file upload is successful, proceed with adding data
        if (add($_POST) > 0) {
            echo "
                <script>
                alert('Data successfully added');
                document.location.href = 'index.php';
                </script>
            ";
        } else {
            echo "
                <script>
                alert('Failed to add data');
                document.location.href = 'index.php';
                </script>
            ";
        }
    }
}
?>






    <!-- //     var_dump($_POST);
    // $No = $_POST["No"];
    // $ProfilePic = $_POST["ProfilePic"];
    // $firstName = $_POST["firstName"];
    // $lastName = $_POST["lastName"];
    // $email = $_POST["email"];
    // $password = $_POST["password"];
    // $bio = $_POST["bio"];

    // $query = "INSERT INTO attendance VALUES('', '$No', '$ProfilePic', '$firstName', '$lastName'
    // , '$email', '$password', '$bio')";
    
    
    // mysqli_query($conn, $query);
    
    //check if its working
    // var_dump(mysqli_affected_rows($conn) > 0);

    // if (mysqli_affected_rows($conn) > 0) {
    //     echo "berhasil";
    // } else {
    //     echo "gagal";
    //     echo "<br>";
    //     echo mysqli_error($conn);
    // } -->












<!DOCTYPE html>
<html>
<head>
<title>Add new Data</title>
</head>
<body>
    <h1>Add new students data</h1>
    <link rel="stylesheet" href="add.css">
    <form actions ="" method="post" enctype="multipart/form-data">

        <ul>

            <li>
               
                <label for = "No">No : </label>
                <input type="text" name="No" id="No">

            </li>

            <li>
               
                <label for = "ProfilePic">ProfilePic : </label>
                <input type="file" name="ProfilePic" id="ProfilePic">

            </li>
               
            <li>

                <label for = "firstName">firstName : </label>
                <input type="text" name="firstName" id="firstName"
                required>

            </li>

                <li>

                <label for = "lastName">lastName : </label>
                <input type="text" name="lastName" id="lastName"
                required>

            </li>
            <li>

                <label for = "email">email : </label>
                <input type="text" name="email" id="email"
                required>

            </li>
            <li>

                <label for = "password">password : </label>
                <input type="text" name="password" id="password"
                required>

            </li>
             <li>

                <label for = "bio">bio : </label>
                <input type="text" name="bio" id="bio">

            </li>

            <li>

            <button type="submit" name="Submit">Submit</button>

            </li>



        </ul>   

    </form>

    
</body>
</html>