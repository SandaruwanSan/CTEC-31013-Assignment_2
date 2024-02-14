
<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Include database connection
include 'db_connection.php'; 

// Fetch user details from the database
$username = $_SESSION['username'];
$sql = "SELECT * FROM user WHERE username = '$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // User details found
    $row = $result->fetch_assoc();
} else {
   
   
    header("Location: admin.php");
    exit;
}

// Handle form submission for updating user details
if(isset($_POST['update'])) {
    // Retrieve form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $user_id = $_POST['user_id'];
    $password = $_POST['password'];
    // Update user details in the database
    $sql_update = "UPDATE user SET username='$username', first_name = '$firstname', last_name = '$lastname', email = '$email' WHERE user_id = '$user_id'";
    if ($conn->query($sql_update) === TRUE) {
        // Reload page after successful update
        echo "Updating Details Successful ";
        header("Location: admin.php");
     
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Handle form submission for deleting user
if(isset($_POST['delete'])) {
    // Delete user from the database
    $sql_delete = "DELETE FROM user WHERE username = '$username'";
    if ($conn->query($sql_delete) === TRUE) {
        // Redirect to logout page after successful deletion
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
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f2f2f2;
        }
        h1 {
            color: #333;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .delete-btn {
            background-color: #f44336;
        }
        .delete-btn:hover {
            background-color: #d32f2f;
        }
        .btn-secondary {
            color: #fff;
            background-color: #6c757d;
            border-color: #6c757d;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }
    </style>
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
    <form method="post" action="">
        <input type="submit" name="delete" value="Delete" class="delete-btn"><br><br><br> 
        <a href="admin.php" class="btn btn-secondary">Admin Page</a>
    </form>
</body>
</html>

