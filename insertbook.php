<?php
// Start session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "library_system";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Function to validate book ID format
function validateBookID($bookID) {
    return preg_match('/^B\d{3}$/', $bookID);
}

// Fetch category names from the database
$sql_categories = "SELECT * FROM bookcategory";
$result_categories = $conn->query($sql_categories);

// Book insertion
if(isset($_POST['insert_book'])) {
    $bookID = $_POST['bookID'];
    $bookName = $_POST['bookName'];
    $categoryID = $_POST['categoryID'];

    // Validate book ID format using regular expression
    if (!validateBookID($bookID)) {
        echo "Invalid Book ID format. Book ID should be in the format 'B<BOOK_ID>'.";
    } else {
        // Insert book into database
        $sql_insert = "INSERT INTO book (book_id, book_name, category_id) VALUES ('$bookID', '$bookName', '$categoryID')";
        if ($conn->query($sql_insert) === TRUE) {
            echo "Book inserted successfully.";
        } else {
            echo "Error: " . $sql_insert . "<br>" . $conn->error;
        }
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head><style>
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

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Insert Book</h2>
        <!-- Book Insertion Form -->
        <form method="post" action="">
            <div class="form-group">
                <label for="bookID">Book ID</label>
                <input type="text" class="form-control" id="bookID" name="bookID" required>
            </div>
            <div class="form-group">
                <label for="bookName">Book Name</label>
                <input type="text" class="form-control" id="bookName" name="bookName" required>
            </div>
            <div class="form-group">
                <label for="categoryID">Category</label>
                <select class="form-control" id="categoryID" name="categoryID" required>
                    <?php
                    if ($result_categories->num_rows > 0) {
                        while($row_category = $result_categories->fetch_assoc()) {
                            echo "<option value='" . $row_category['category_id'] . "'>" . $row_category['category_Name'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No categories found</option>";
                    }
                    ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="insert_book">Insert Book</button> <a href="admin.php" class="btn btn-secondary">Admin Page</a>
            <a href="listallbook.php" class="btn btn-secondary">Book List Page</a>
        </form>
    </div>
</body>
</html>
