<?php

session_start();


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_system";

$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if(isset($_GET['borrow_id'])) {
    $borrow_id = $_GET['borrow_id'];

    
    $sql = "SELECT * FROM bookborrower WHERE borrow_id='$borrow_id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $book_id = $row['book_id'];
        $member_id = $row['member_id'];
        $borrow_status = $row['borrow_status'];
        $borrower_date_modified = $row['borrower_date_modified'];
    } else {
        echo "No borrow record found with ID: $borrow_id";
        exit;
    }
} else {
    echo "Borrow ID not provided.";
    exit;
}

// Handle update operation when the form is submitted
if(isset($_POST['update'])) {
    // Retrieve form data
    $book_id = $_POST['book_id'];
    $member_id = $_POST['member_id'];
    $borrow_status = $_POST['borrow_status'];

    // Update borrow record in the database
    $sql_update = "UPDATE bookborrower SET book_id='$book_id', member_id='$member_id', borrow_status='$borrow_status', borrower_date_modified=NOW() WHERE borrow_id='$borrow_id'";
    if ($conn->query($sql_update) === TRUE) {
        echo "Borrow record updated successfully.";
        // Redirect to the manage_borrows.php page after updating
        header("Location: addbookborrowings.php");
        exit;
    } else {
        echo "Error updating borrow record: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Borrow Record</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f5f5f5;
        }
        h2 {
            color: #333;
            text-align: center;
        }
        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        input[type="text"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        a {
    position: relative;
    top: 20px; 
    left: 650px;
}
    </style>
</head>
<body>
    <h2>Update Borrow Record</h2>
    <form method="post" action="">
        <input type="hidden" name="borrow_id" value="<?php echo $borrow_id; ?>">
        Book ID: <input type="text" name="book_id" value="<?php echo $book_id; ?>"><br><br>
        Member ID: <input type="text" name="member_id" value="<?php echo $member_id; ?>"><br><br>
        Borrow Status:
        <select name="borrow_status">
            <option value="borrowed" <?php if($borrow_status == 'borrowed') echo 'selected'; ?>>Borrowed</option>
            <option value="available" <?php if($borrow_status == 'available') echo 'selected'; ?>>Available</option>
        </select><br><br>
        Borrower Date Modified: <?php echo $borrower_date_modified; ?><br><br>
        <input type="submit" name="update" value="Update">
    </form>
    <a href="admin.php" class="btn btn-info">Admin Page</a>
</body>
</html>

<?php

$conn->close();
?>
