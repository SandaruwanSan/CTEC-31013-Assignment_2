<?php
// Set default time zone
date_default_timezone_set('Asia/Colombo');

include 'db_connection.php';

if(isset($_POST['submit'])) {
    // Retrieve form data
    $category_id = $_POST['category_id'];
    $category_name = $_POST['category_name'];
    
    // Get current timestamp for updated time
    $date_modified = date("Y-m-d H:i:s");

    // Validate Category ID format
    if (!preg_match('/^C\d{3}$/', $category_id)) {
        echo "<p class='error-message'>Error: Category ID should be in the format 'C001'.</p>";
    } else {
        // Insert into database
        $sql = "INSERT INTO bookcategory (category_id, category_Name, date_modified) VALUES ('$category_id', '$category_name', '$date_modified')";
        if ($conn->query($sql) === TRUE) {
            echo "<p class='success-message'>Category added successfully.</p>";
        } else {
            echo "<p class='error-message'>Error adding category: " . $conn->error . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        form {
            max-width: 400px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
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

        .error-message {
            color: red;
            font-style: italic;
        }

        .success-message {
            color: green;
        }

        .back-link {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s, transform 0.3s;
            margin-top: 10px;
        }

        .back-link:hover {
            background-color: #45a049;
        }

        .back-link:active {
            background-color: #3e8e41;
        }

        .back-link::after {
            content: '\2190';
            margin-left: 5px;
        }

        .back-link:hover::after {
            transform: translateX(-3px);
        }
    </style>
</head>
<body>
    <form method="post" action="">
        Category ID: <input type="text" name="category_id" pattern="C\d{3}" title="Category ID should be in the format 'C001'"><br>
        Category Name: <input type="text" name="category_name"><br>
        <input type="submit" name="submit" value="Add Category">
        <?php if(isset($error_message)) { ?>
            <p class="error-message"><?php echo $error_message; ?></p>
        <?php } ?>
        <?php if(isset($success_message)) { ?>
            <p class="success-message"><?php echo $success_message; ?></p>
        <?php } ?>
    </form>
    <a class="back-link" href="manage_book_category.php">Back To Book Category</a>
</body>
</html>
