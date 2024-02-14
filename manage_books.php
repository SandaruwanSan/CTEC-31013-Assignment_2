<?php
// Start session
session_start();

// Database connection
include 'db_connection.php';
// Function to retrieve book data
function getBooks() {
    global $conn;
    $sql = "SELECT book.*, bookcategory.category_Name 
            FROM book 
            INNER JOIN bookcategory ON book.category_id = bookcategory.category_id";
    $result = $conn->query($sql);
    return $result;
}

// Function to delete a book
function deleteBook($bookID) {
    global $conn;
    $sql = "DELETE FROM book WHERE book_id='$bookID'";
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

// Logout
if(isset($_POST['logout'])) {
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit;
}

// Handle delete book request
if(isset($_POST['delete_book'])) {
    $bookID = $_POST['book_id'];
    if(deleteBook($bookID)) {
        echo "Book deleted successfully.";
    } else {
        echo "Error deleting book.";
    }
}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Books</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="my-4">Manage Books</h2>
      
        <table class="table">
            <thead>
                <tr>
                    <th>Book ID</th>
                    <th>Book Name</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                    $books = getBooks();
                    if ($books->num_rows > 0) {
                        while($row = $books->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['book_id'] . "</td>";
                            echo "<td>" . $row['book_name'] . "</td>";
                            echo "<td>" . $row['category_Name'] . "</td>";
                            echo "<td>
                                <form method='post' action='update_book.php'>
                                    <input type='hidden' name='book_id' value='" . $row['book_id'] . "'>
                                    <input type='hidden' name='book_name' value='" . $row['book_name'] . "'>
                                    <input type='hidden' name='category_id' value='" . $row['category_id'] . "'>




                                    <input type='submit' name='update_book' value='Update' class='btn btn-primary btn-sm'>

                                </form>
                                <form method='post' action=''>
                                    <input type='hidden' name='book_id' value='" . $row['book_id'] . "'>
                                    <input type='submit' name='delete_book' value='Delete' class='btn btn-danger btn-sm'>
                                </form>
                            </td>";
                            echo "</tr>";
                        }
                    } else {
                    echo "<tr><td colspan='4'>No books found.</td></tr>";
                    }
                    ?>
            </tbody>
        </table>
    </div>
    <form method="post" action="">
            <input type="submit" name="logout" value="Logout" class="btn btn-danger mb-3"><br><a href="admin.php" class="btn btn-secondary">Admin Page</a><p>   </p><a href="listallbook.php" class="btn btn-secondary">Book List Page</a>
        </form>

        
</body>
</html>
