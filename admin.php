<?php
session_start();
// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Include database connection
include 'db_connection.php'; 
// Fetch all users from the database
$sql = "SELECT * FROM user";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #E6E2E1; 
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: lightblue; 
        }
        .table-striped tbody tr:nth-of-type(even) {
            background-color: lightcoral;
        }
        .logout-btn {
            position: absolute; 
            top: 10px; 
            right: 10px; 
        }
    </style>
</head>
<body>
    <div class="container">
        
        <a href="logout.php" class="btn btn-danger logout-btn">Logout</a>
        <center><i><b><h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1><br><br></b></i></center>
        <h2>Staff Member List</h2><br><br>
   
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>User ID</th>
                        <th>Firstname</th>
                        <th>Lastname</th>
                        <th>Username</th>
                        <th>Email</th>
                      
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['user_id'] . "</td>";
                            echo "<td>" . $row['first_name'] . "</td>";
                            echo "<td>" . $row['last_name'] . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                    
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No users found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    
        <div class="like-buttons">
            <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>     
           <a href="listallbooks.php" class="btn btn-info">List All Books</a>
            <a href="listbookcategory.php" class="btn btn-info">List Book Categories</a>
            <a href="addmembers.php" class="btn btn-info">List Members</a>
            <a href="addbookborrowings.php" class="btn btn-info">List Book Borrowings</a>
            <a href="addfine.php" class="btn btn-info">Add Fines</a>
        </div>
    </div>
</body>
</html>


