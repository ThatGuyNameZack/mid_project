<?php
$conn = mysqli_connect("localhost", "root", "", "attendancephp");

function query($query) {
    global $conn;
    $result = mysqli_query($conn, $query);

    if (!$result) {
        // Handle the error, for now, let's just echo it, error checking
        echo "Error: " . mysqli_error($conn);
        return false;
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function add($data) {
        global $conn;
        
        $No = htmlspecialchars($data["No"]);
        // $ProfilePic = htmlspecialchars($data["ProfilePic"]);
       //upload pic
        $ProfilePic = upload();
        if( !$ProfilePic === false){
            return false;
        }
        
        $firstName = htmlspecialchars($data["firstName"]);
        $lastName = htmlspecialchars($data["lastName"]);
        $email = htmlspecialchars($data["email"]);
        $password = htmlspecialchars($data["password"]);
        $bio = htmlspecialchars($data["bio"]);

        $query = "INSERT INTO attendance VALUES('', '$No', '$ProfilePic', '$firstName', '$lastName'
        , '$email', '$password', '$bio')";


        mysqli_query($conn, $query);

        return mysqli_affected_rows($conn);
        }


//         function upload()
//         {
//         global $conn;       
        
//         if (!isset($_FILES['ProfilePic'])) {
//             echo "No file submitted. ";
//             var_dump($_FILES);  // Output the entire $_FILES array for debugging
//             return false;
//         }
        
        
//         if (isset($_FILES['ProfilePic'])) {
//             // Process the upload
//             $ProfilePic = upload();
//         }
        
       
    
//     $fileName = $_FILES['ProfilePic']['name'];
//     $fileSize = $_FILES['ProfilePic']['size'];
//     $error = $_FILES['ProfilePic']['error'];
//     $tmpName = $_FILES['ProfilePic']['tmp_name'];

//     if ($error === 4) {
//         echo "<script>alert('Pick the image first!');</script>";
//         return false;
//     }

//     // Allowed types of files
//     $imageExtensionValid = ['jpg', 'jpeg', 'png'];
//     $extensionImage = explode('.', $fileName);
//     $extensionImage = strtolower(end($extensionImage));
//     if (!in_array($extensionImage, $imageExtensionValid)) {
//         echo "<script>alert('You did not upload the right file');</script>";
//         return false;
//     }

//     // Putting an image size limit
//     if ($fileSize > 100000) {
//         echo "<script>alert('File size is too large to upload!');</script>";
//         return false;
//     }

//     // Generate a new name
//     $newNameFile = uniqid();
//     $newNameFile .= '.';
//     $newNameFile .= $extensionImage;

//     // For example, move the uploaded file to a specific directory
//     move_uploaded_file($tmpName, 'sexy/' . $newNameFile);

//     // Return the new file name
//     return $newNameFile;
// }

// // Example usage
// $ProfilePic = upload();

// // Check if the upload was successful
// if ($ProfilePic) {
//     echo "Upload successful. New file name: $ProfilePic";
// } else {
//     echo "Upload failed.";
// }




        function delete($id){
            global $conn;
            mysqli_query($conn, "DELETE FROM attendance WHERE id = $id");

            return mysqli_affected_rows($conn);
        }

        function change($data) {
            global $conn;
        
            $id = $data["id"];
            $firstName = htmlspecialchars($data["firstName"]);
            $lastName = htmlspecialchars($data["lastName"]); 
            $email = htmlspecialchars($data["email"]);
            $password = htmlspecialchars($data["password"]);
            $bio = htmlspecialchars($data["bio"]);


        
            $query = "UPDATE attendance SET
                firstName = '$firstName',
                lastName = '$lastName',
                email = '$email',
                password = '$password',
                bio = '$bio'
                WHERE id = $id";
        
            // Execute the query
            mysqli_query($conn, $query);
        
            // Check if the query was successful
            if (mysqli_affected_rows($conn) > 0) {
                return mysqli_affected_rows($conn);
            } else {
                // Query failed, handle the error
                echo "Error: " . mysqli_error($conn);
                return -1; 
            }
        }
        
        function search($keyword) {
            global $conn;
        
            $query = "SELECT * FROM attendance WHERE firstName LIKE '%$keyword%' OR lastName LIKE '%$keyword%'
              OR email LIKE '%$keyword%'";
            $result = query($query);
        
            // Check if the query execution was successful
            if ($result === false) {
                return []; 
            }
        
            return $result;
        }

        function register($data) {
            global $conn;
        
            $username = strtolower(stripslashes($data["username"]));
            $password = mysqli_real_escape_string($conn, $data['password']);
            $password2 = mysqli_real_escape_string($conn, $data['password2']);
        
            // Check if username already exists
            $result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
            if (mysqli_fetch_assoc($result)) {
                echo "<script> alert('Username already exists');</script>";
                return false;
            }
        
            // For confirmation
            if ($password !== $password2) {
                echo "<script>alert('Passwords do not match!');</script>";
                return false;
            }
        
            // Password encryption
            $password = password_hash($password, PASSWORD_DEFAULT);
        
            // Database query
            $queryResult = mysqli_query($conn, "INSERT INTO users VALUES('', '$username', '$password')");
        
            if (!$queryResult) {
                echo "Error: " . mysqli_error($conn);
                return false;
            }
        
            return mysqli_affected_rows($conn);
        }
        

?>