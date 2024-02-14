<?php
// creating database connection
include 'db_connection.php';

date_default_timezone_set('Asia/Colombo');
session_start();
// checking passing method of id and category name
if($_SERVER['REQUEST_METHOD']=='POST') {
    $category_id = $_POST['category_id'];
    $new_category_name = $_POST['category_name'];

    // using current timestamp for time setting
    $updated_time = date('Y-m-d H:i:s');}
    else {
        echo "Category ID or Category Name not provided.";
    }
session_destroy();

    // updating category name and time in database
    if(isset($_POST['category_id']) && isset($_POST['category_name'])) {
        $category_id = $_POST['category_id'];
        $new_category_name = $_POST['category_name'];
    
        // using current timestamp for time setting
        $updated_time = date('Y-m-d H:i:s');
    $sql_update = "UPDATE bookcategory SET category_Name='$new_category_name', date_modified='$updated_time' WHERE category_id='$category_id'";
    if ($conn->query($sql_update) === TRUE) {
        echo "";
       
    } else {
        echo "Error updating category: " . $conn->error;
    }
} else {
    echo "";
}



//down the database conection
$conn->close();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
</head>
<body>
    <h2>Update Category</h2>
    <form method="post" action="">
        <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
        Category Name: <input type="text" name="category_name" value="<?php echo $new_category_name; ?>"><br><br>
        <input type="submit" name="update" value="Update">
        <a href="manage_book_category.php">Catagories</a>
    </form>
</body>
</html>
