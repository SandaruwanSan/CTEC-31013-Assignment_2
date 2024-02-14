<?php
// creating database connection
include 'db_connection.php';

//validating id passing method
if(isset($_GET['id'])) {
    $category_id = $_GET['id'];
    // Deleting category from database
    $sql = "DELETE FROM book_categories WHERE category_id='$category_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Category deleted successfully.";
    } else {
        echo "Error deleting category: " . $conn->error;
    }
}
?>
