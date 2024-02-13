
<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

//database connection
include 'db_connection.php'; 


$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User details founding
    $row = $result->fetch_assoc();
} else {
    
    header("Location: admin.php");
    exit;
}


if(isset($_POST['update'])) {
    // Retrieve form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];
 
    $sql_update = "UPDATE user SET username='$username', first_name = '$firstname', last_name = '$lastname', email = '$email' WHERE user_id = '$user_id'";
    if ($conn->query($sql_update) === TRUE) {
       
        echo "Updating Details Successful ";
        header("Location: admin.php");
     
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}


if(isset($_POST['delete'])) {
    
    $sql_delete = "DELETE FROM user WHERE username = '$username'";
    if ($conn->query($sql_delete) === TRUE) {
        
        header("Location: logout.php");
        exit;
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
</head>
<body>
    <h1>Edit Your Profile</h1>
    <form method="post" action="">
        UserID: <input type="text" name="user_id" value="<?php echo $row['user_id']; ?>"><br>
        Username: <input type="text" name="username" value="<?php echo $row['username']; ?>"><br>
        Firstname: <input type="text" name="firstname" value="<?php echo $row['first_name']; ?>"><br>
        Lastname: <input type="text" name="lastname" value="<?php echo $row['last_name']; ?>"><br>
        Email: <input type="email" name="email" value="<?php echo $row['email']; ?>"><br>
        Password: <input type="password" name="password" value="<?php echo $row['password']; ?>"><br>
        <input type="submit" name="update" value="Update">
    </form>
    <br>
    <form method="post" action="">
        <input type="submit" name="delete" value="Delete">
    </form>
</body>
</html>
