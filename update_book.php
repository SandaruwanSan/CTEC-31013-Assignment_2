<?php
// Start session
session_start();

//CT-2019-038
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

// Function to retrieve book details
function getBookDetails($bookID) {
    global $conn;
    $sql = "SELECT * FROM book WHERE book_id='$bookID'";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

// Function to retrieve all categories
function getAllCategories() {
    global $conn;
    $sql = "SELECT * FROM bookcategory";
    $result = $conn->query($sql);
    return $result;
}

// Function to update book details
function updateBook($bookID, $bookName, $categoryID) {
    global $conn;
    $sql = "UPDATE book SET book_name='$bookName', category_id='$categoryID' WHERE book_id='$bookID'";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: login.php");
    exit;
}

// Handle update book request
$updateMessage = "";
if(isset($_POST['update_books'])) {
    $bookID = $_POST['book_id'];
    $bookName = $_POST['book_name'];
    $categoryID = $_POST['category_id'];
    if(updateBook($bookID, $bookName, $categoryID)) {
        $updateMessage = "succesfull";
    } else {
        $updateMessage = "Error updating book.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Book</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Update Book Details</h2>
        <?php if(!empty($updateMessage)) echo "<div class='alert alert-success'>$updateMessage</div>"; ?>
        <form method="post" action="">
            <input type="hidden" name="book_id" value="<?php echo $_POST['book_id']; ?>">
            Book Name: <input type="text" name="book_name" value="<?php echo $_POST['book_name']; ?>"><br><br>
            Category: 
            <select name="category_id">
                <?php
                $categories = getAllCategories();
                if ($categories->num_rows > 0) {
                    while($row = $categories->fetch_assoc()) {
                        $selected = ($_POST['category_id'] == $row['category_id']) ? "selected" : "";
                        echo "<option value='" . $row['category_id'] . "' $selected>" . $row['category_Name'] . "</option>";
                    }
                }
                ?>
            </select><br><br>
            <input type="submit" name="update_books" value="Update Book" class="btn btn-primary">
           
<a href="manage_books.php" class="btn btn-secondary">Back to Manage Books</a>

        </form>
    </div>
</body>
</html>