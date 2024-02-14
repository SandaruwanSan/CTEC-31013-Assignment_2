<?php

include 'db_connection.php';
date_default_timezone_set('Asia/Colombo');


function addBorrowDetails($borrowID, $bookID, $memberID, $borrowStatus, $modifiedDate) {
    global $conn;
    $sql = "INSERT INTO bookborrower (borrow_id, book_id, member_id, borrow_status, borrower_date_modified) VALUES ('$borrowID', '$bookID', '$memberID', '$borrowStatus', '$modifiedDate')";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}


function updateBorrowDetails($borrowID, $bookID, $borrowStatus, $modifiedDate) {
    global $conn;
    $sql = "UPDATE bookborrower SET book_id='$bookID', borrow_status='$borrowStatus', borrower_date_modified='$modifiedDate' WHERE borrow_id='$borrowID'";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}


function deleteBorrowDetails($borrowID) {
    global $conn;
    $sql = "DELETE FROM bookborrower WHERE borrow_id='$borrowID'";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Handle form submissions
if(isset($_POST['add_borrow'])) {
   
    $borrowID = $_POST['borrow_id'];
    $bookID = $_POST['book_id'];
    $memberID = $_POST['member_id'];
    $borrowStatus = $_POST['borrow_status'];
    $modifiedDate = date("Y-m-d H:i:s");


    if (!preg_match('/^BR\d{3}$/', $borrowID)) {
        echo "Error: Borrow ID should be in the format 'BR001'.";
    } elseif (!preg_match('/^B\d{3}$/', $bookID)) {
        echo "Error: Book ID should be in the format 'B001'.";
    } elseif (!preg_match('/^M\d{3}$/', $memberID)) {
        echo "Error: Member ID should be in the format 'M001'.";
    } else {
        
        if(addBorrowDetails($borrowID, $bookID, $memberID, $borrowStatus, $modifiedDate)) {
            echo "Borrow details added successfully.";
        } else {
            echo "Error adding borrow details.";
        }
    }
}

if(isset($_POST['update_borrow'])) {
    
    $borrowID = $_POST['borrow_id'];
    $bookID = $_POST['book_id'];
    $borrowStatus = $_POST['borrow_status'];
    $modifiedDate = date("Y-m-d H:i:s");



    
    if(updateBorrowDetails($borrowID, $bookID, $borrowStatus, $modifiedDate)) {
        echo "Borrow details updated successfully.";
    } else {
        echo "Error updating borrow details.";
    }
}

if(isset($_POST['delete_borrow'])) {
   
    $borrowID = $_POST['borrow_id'];

    
    if(deleteBorrowDetails($borrowID)) {
        echo "Borrow details deleted successfully.";
    } else {
        echo "Error deleting borrow details.";
    }
}


function getBorrowRecords() {
    global $conn;
    $sql = "SELECT * FROM bookborrower";
    $result = $conn->query($sql);
    return $result;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Book Borrow Details</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }

        h2, h3 {
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .form-container {
            max-width: 500px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
            margin-right: 20px;
            margin-left: -250px;
        }

        input[type="text"], select {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        table {
            border-collapse: collapse;
          
            margin-bottom: 20px;
            width: 160%;
            margin: 0 auto; 
            margin-left: -130px;
            margin-right: 100px; 
            
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        a {
    position: relative;
    top: 20px;
    left: 50px; 
}
        h1 {
    margin-top: 30px;
    margin-bottom: 20px;
    margin-left: -230px;
    margin-right: 100px;
    font-family: Arial, sans-serif;
    color: #333; 
     
}
    </style>
</head>
<body>
    <div class="container">
        <b><h1>Manage Book Borrow Details</h1></b><br>

        <div class="row">
            <div class="col-md-5"> 
                <!-- Input Form -->
                <div class="form-container">
                    <h3>Add Borrow Details</h3>
                    <form method="post" action="">
                        Borrow ID: <input type="text" name="borrow_id"><br>
                        Book ID: <input type="text" name="book_id"><br>
                        Member ID: <input type="text" name="member_id"><br>
                        Borrow Status:
                        <select name="borrow_status">
                            <option value="borrowed">Borrowed</option>
                            <option value="available">Available</option>
                        </select><br>
                        <input type="submit" name="add_borrow" value="Add Borrow Details">
                    </form>
                </div>
            </div>
            <div class="col-md-7"> 
                <!-- Borrow Records Table -->
                <h3>Borrow Records</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Borrow ID</th>
                            <th>Book ID</th>
                            <th>Member ID</th>
                            <th>Borrow Status</th>
                            <th>Modified Date</th>
                            <th width='200px'>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $records = getBorrowRecords();
                        if ($records->num_rows > 0) {
                            while($row = $records->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>" . $row["borrow_id"] . "</td>";
                                echo "<td>" . $row["book_id"] . "</td>";
                                echo "<td>" . $row["member_id"] . "</td>";
                                echo "<td>" . $row["borrow_status"] . "</td>";
                                echo "<td>" . $row["borrower_date_modified"] . "</td>";
                                echo "<td>
                                    <form method='get' action='updatebookborrowings.php'>
                                        <input type='hidden' name='borrow_id' value='" . $row['borrow_id'] . "'>
                                        <input type='submit' name='update_borrow' value='Update' class='btn btn-primary'>
                                    </form>
                                    <form method='post' action=''>
                                        <input type='hidden' name='borrow_id' value='" . $row['borrow_id'] . "'>
                                        <input type='submit' name='delete_borrow' value='Delete' class='btn btn-danger'>
                                    </form>
                                </td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No records found.</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <a href="admin.php" class="btn btn-info">Admin Page</a>
</body>
</html>
