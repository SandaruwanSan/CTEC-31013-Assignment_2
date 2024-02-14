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
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
        h2 {
            color: #333;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 0 auto;
        }
        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
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
        a {
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <center><h2>Update Category</h2></center>
    <form method="post" action="">
        <input type="hidden" name="category_id" value="<?php echo $category_id; ?>">
        Category Name: <input type="text" name="category_name" value="<?php echo $new_category_name; ?>"><br><br>
        <input type="submit" name="update" value="Update">
        <a href="manage_book_category.php">Categories</a>
    </form>
</body>
</html>

