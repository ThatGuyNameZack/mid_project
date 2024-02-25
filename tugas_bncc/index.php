<?php

session_start();

//connect to database
require 'functions.php';

$attendance = query("SELECT * FROM attendance");
$i = 1;

// Button for searching
if (isset($_POST["search"])) {
    $searchResult = search($_POST["keyword"]);

    // Check if the search was successful
    if (!empty($searchResult)) {
        $attendance = $searchResult;
    } else {
        echo "No results found."; 
    }
}

if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    header("Location: login.php");
    exit;
}

//-----------------------------------------------------
// // Check connection
// if (!$conn) {
//     die("Connection failed: " . mysqli_connect_error());
// } else {
//     echo "Connected to the database successfully!<br>";
// }

// // Fetch data from the database
// $result = mysqli_query($conn, "SELECT * FROM attendance");



// // Check if the query was successful
// if (!$result) {
//     die("Error in SQL query: " . mysqli_error($conn));
// } else {
//     echo "Query executed successfully!<br>";
// }
//--------------------------------------------------------

?>



<!DOCTYPE html>

<html>
    <head>
        <title>Attendance System</title>
    </head>
    <body>
        

<nav>
    <a href="logout.php" class="button">Logout</a>
    <a href="add.php" class="button">Add new Student Information</a>
</nav>



    
   

        <h1>Daftar Mahasiswa</h1>
        <link rel="stylesheet" href="style.css">
        <br></br>
        

            <form action="" method="post">
                <input type="text" name="keyword" size="40" autofocus placeholder="enter the keyword..." 
                    autocomplete="off">
                <button type="submit" name="search">Search!</button>
            </form>
          
            <br></br>  
        
        <table border="1" cellpadding="10" cellspacing="0">

            <tr>
                <th>No</th>
                <th>Actions</th>
                <th>ProfilePic</th>
                <th>firstName</th>
                <th>lastName</th>
                <th>email</th>
                <th>password</th>
                <th>bio</th>
            </tr>
       

            <?php foreach( $attendance as $row ) : ?>
            
                
                <tr>
                
                <td><?= $i; ?></td>           
                
                <td>
    <a href="change.php?id=<?= $row["id"]; ?>" class="change">Change</a>
    <a href="delete.php?id=<?= $row["id"]; ?>" class="delete" onclick="return confirm('Are you sure?');">Delete</a>
                </td>


                
                <td><img src="sexy/<?php echo $row['ProfilePic']; ?>" /></td>
                
            
                <td><?= $row["firstName"]; ?></td>
                <td><?= $row["lastName"]; ?></td>
                <td><?= $row["email"]; ?></td>
                <td><?= $row["password"]; ?></td>
                <td><?= $row["bio"]; ?></td>

            </tr>
            <?php $i++; ?>
            <?php endforeach; ?>
        
        </table>

    </body>
</html>
