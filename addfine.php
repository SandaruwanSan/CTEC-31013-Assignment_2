<?php
// Include database connection
include 'db_connection.php';
date_default_timezone_set('Asia/Colombo');

// Define validation function for fine amount
function validateFineAmount($amount) {
    return ($amount >= 2 && $amount <= 500);
}

// Check if the form has been submitted for assigning fine
if(isset($_POST['insert_submit'])) {
    // Assign submitted data to variables
    $fine_id = $_POST['fine_id'];
    $member_id = $_POST['member_id'];
    $book_id = $_POST['book_id'];
    $fine_amount = $_POST['fine_amount'];
    $date_modified = date('Y-m-d h:i:sa');


    // Validate fine amount
    if(validateFineAmount($fine_amount)) {
        // Insert the fine details into the database
        $sql_insert = "INSERT INTO fine (fine_id, member_id, book_id, fine_amount, fine_date_modified)
                       VALUES ('$fine_id', '$member_id', '$book_id', '$fine_amount', '$date_modified')";
        
        if ($conn->query($sql_insert) === TRUE) {
            echo "Fine assigned successfully.";
        } else {
            echo "Error assigning fine: " . $conn->error;
        }
    } else {
        echo "Error: Fine amount must be between 2 LKR and 500 LKR.";
    }
}

// Check if the form has been submitted for updating fine
if(isset($_POST['update_submit'])) {
    // Assign submitted data to variables
    $fine_id = $_POST['fine_id'];
    $member_id = $_POST['member_id'];
    $book_id = $_POST['book_id'];
    $fine_amount = $_POST['fine_amount'];
    $date_modified = date('Y-m-d h:i:sa');


    // Validate fine amount
    if(validateFineAmount($fine_amount)) {
        // Update the fine details in the database
        $sql_update = "UPDATE fine SET member_id='$member_id', book_id='$book_id', fine_amount='$fine_amount', fine_date_modified='$date_modified' WHERE fine_id='$fine_id'";
        if ($conn->query($sql_update) === TRUE) {
            echo "Fine updated successfully.";
        } else {
            echo "Error updating fine: " . $conn->error;
        }
    } else {
        echo "Error: Fine amount must be between 2 LKR and 500 LKR.";
    }
}

// Check if the form has been submitted for deleting fine
if(isset($_POST['delete_submit'])) {
    // Assign submitted data to variables
    $fine_id = $_POST['fine_id'];

    // Delete the fine details from the database
    $sql_delete = "DELETE FROM fine WHERE fine_id='$fine_id'";
    if ($conn->query($sql_delete) === TRUE) {
        echo "Fine deleted successfully.";
    } else {
        echo "Error deleting fine: " . $conn->error;
    }
}

// Fetch all fines from the database
$sql_select = "SELECT * FROM fine";
$result = $conn->query($sql_select);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Fines</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        body {
            padding: 20px;
        }
        h2 {
            margin-bottom: 20px;
        }
        table {
            width: 100%;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Fines</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom CSS */
        body {
            padding: 20px;
            background-color:#edb7ea;
        }
        .container {
            display: flex;
            justify-content: space-between;
            
            
        }
        .form-container {
            width: 45%; /* Adjust this value as needed */
            background-color: lightgreen;
            height: 45%;
        }
        .form-container form .form-group {
     margin-bottom: 20px;
     margin-left: 20px;
     margin-right: 20px;
     background-color: lightblue;
}



        table {
            width: 50%; /* Adjust this value as needed */
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .admin-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
        .admin-link a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container form-group">
            <h2>Assign Fine</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label>Fine ID:</label>
                    <input type="text" class="form-control" name="fine_id" required>
                </div>
                <div class="form-group">
                    <label>Member ID:</label>
                    <input type="text" class="form-control" name="member_id" required>
                </div>
                <div class="form-group">
                    <label>Book ID:</label>
                    <input type="text" class="form-control" name="book_id" required>
                </div>
                <div class="form-group">
                    <label>Fine Amount (LKR):</label>
                    <input type="number" class="form-control" name="fine_amount" min="2" max="500" required>
                </div>
                <input type="submit" class="btn btn-primary" name="insert_submit" value="Assign Fine">
            </form>
        </div>

        <div class="form-container">
            <h2>Update Fine</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label>Fine ID:</label>
                    <input type="text" class="form-control" name="fine_id" required>
                </div>
                <div class="form-group">
                    <label>Member ID:</label>
                    <input type="text" class="form-control" name="member_id" required>
                </div>
                <div class="form-group">
                    <label>Book ID:</label>
                    <input type="text" class="form-control" name="book_id" required>
                </div>
                <div class="form-group">
                    <label>Fine Amount (LKR):</label>
                    <input type="number" class="form-control" name="fine_amount" min="2" max="500" required>
                </div>
                <input type="submit" class="btn btn-primary" name="update_submit" value="Update Fine">
            </form>
        </div>

        <div class="form-container">
            <h2>Delete Fine</h2>
            <form method="post" action="">
                <div class="form-group">
                    <label>Fine ID:</label>
                    <input type="text" class="form-control" name="fine_id" required>
                </div>
                <input type="submit" class="btn btn-danger" name="delete_submit" value="Delete Fine">
            </form>
        </div>
    </div>
    <div class='admin-link'>
        <a href='admin.php'>Admin Page</a>
    </div>

    <div class="table-container">
        <h2>Assigned Fines</h2>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Fine ID</th>
                    <th>Member ID</th>
                    <th>Book ID</th>
                    <th>Fine Amount (LKR)</th>
                    <th>Date Modified</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["fine_id"] . "</td>";
                        echo "<td>" . $row["member_id"] . "</td>";
                        echo "<td>" . $row["book_id"] . "</td>";
                        echo "<td>" . $row["fine_amount"] . "</td>";
                        echo "<td>" . $row["fine_date_modified"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No fines assigned.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
            </body>
</html>

<?php
// Close database connection
$conn->close();
?>
