<?php
// Start session
//Student-Number-CT-2019-030
session_start();

// Database connection
include 'db_connection.php'; 

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to validate email format
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate password length
function validatePassword($password) {
    return strlen($password) >= 8;
}

// Function to validate user ID format
function validateUserID($userID) {
    return preg_match('/^U\d{3}$/', $userID);
}

// Function to check if email or username already exists
function checkExistingUser($email, $username) {
    global $conn;
    $sql = "SELECT * FROM user WHERE email = '$email' OR username = '$username'";
    $result = $conn->query($sql);
    return $result->num_rows > 0;
}

// User registration
if(isset($_POST['register'])) {
    $userID = $_POST['userID'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (validatePassword($password) && validateEmail($email) && validateUserID($userID) && !checkExistingUser($email, $username)) {
        // Hashing the password
        $hashed_password = md5($password);
        
        $sql = "INSERT INTO user (user_id, first_name, last_name, username, password, email) VALUES ('$userID', '$firstname', '$lastname', '$username', '$hashed_password', '$email')";
        if ($conn->query($sql) === TRUE) {
            echo "Registration successful";
            
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Registration failed. Please check your inputs.";
    }
}


// User login
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = md5($password); // Hash the input password

    $sql = "SELECT * FROM user WHERE username = '$username' AND password = '$hashed_password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Set session variables
        $_SESSION['username'] = $username;
        $_SESSION['loggedin'] = true;
        // Redirect to admin page
        header("Location: admin.php");
        exit;
    } else {
        echo "Login failed. Please check your username and password.";
    }
}


// Logout
if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    echo "Logged out successfully";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System - Login and Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .form-box {
            margin-top: 10px;
            opacity: 0.9;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .container {
            max-width: 800px;
            text-align: center;
        }
        .image-container {
            position: relativeabsolute;
            width: 100px;
            height: 100px;
        }
        .image-container img {
            position: absolute;
            top: 2; /* Adjust the top position of the image */
            left: 3; /* Adjust the left position of the image */
            /* You can also use right and bottom properties to adjust position */
            max-width: 100%;
            max-height: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="text-center my-4">Library Management System</h2>
        <h2 class="text-center my-4">By Team Avengers</h2>
        <div class="image-container">
            <img src="avengers.png" alt="Image">
        </div>
       
    </div>
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="form-box">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Login
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block" name="login">Login</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-box">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            Register
                        </div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label for="userID">User ID</label>
                                    <input type="text" class="form-control" id="userID" name="userID" required>
                                </div>
                                <div class="form-group">
                                    <label for="firstname">Firstname</label>
                                    <input type="text" class="form-control" id="firstname" name="firstname" required>
                                </div>
                                <div class="form-group">
                                    <label for="lastname">Lastname</label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block" name="register">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h3>Welcome to our Web Package</h3>
       
</body>
</html>

