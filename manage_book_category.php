<?php
// creating database connection
include 'db_connection.php';

// Checking the passing method of category id by get method 
if(isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    
    // Deleting category
    $sql_delete = "DELETE FROM bookcategory WHERE category_id='$category_id'";
    if ($conn->query($sql_delete) === TRUE) {
        echo "Category deleted successfully.";
    } else {
        echo "Error deleting category: " . $conn->error;
    }
}

// retrieving book categories from database
$sql = "SELECT * FROM bookcategory";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Book Categories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h2 {
            text-align: center;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        .actions {
            display: flex;
            justify-content: center;
        }
        .actions form {
            margin: 0 5px;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2>Manage Book Categories</h2>
    <table>
        <thead>
            <tr>
                <th>Category ID</th>
                <th>Category Name</th>
                <th>Date Modified</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["category_id"] . "</td>";
                    echo "<td>" . $row["category_Name"] . "</td>";
                    echo "<td>" . $row["date_modified"] . "</td>";
                    echo "<td class='actions'>
                            <form method='post' action='update_category.php'>
                                <input type='hidden' name='category_id' value='" . $row['category_id'] . "'>
                                <input type='hidden' name='category_name' value='" . $row['category_Name'] . "'>
                                <input type='submit' name='update' value='Update'>
                            </form>
                            <form method='get' action=''>
                                <input type='hidden' name='category_id' value='" . $row['category_id'] . "'>
                                <input type='submit' name='delete' value='Delete'>
                            </form>
                        </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No categories found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="listbookcategory.php">Back To Category List</a>  
</body>
</html>


<?php
// Close database connection
$conn->close();
?>
