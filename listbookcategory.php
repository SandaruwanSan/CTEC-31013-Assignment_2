<?php
// creating database connection
include 'db_connection.php';

// use to retrive book categories from database
$sql = "SELECT * FROM bookcategory";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Categories</title>
    <style>
        body {
            font-family: Arial, sans-serif; /* changing the front  type */
            margin: 0;
            padding: 0;
            background-color: #f7f7f7; /* adiing the background colr */
        }
        h2 {
            text-align: center; /*arrange text  allignments*/
            margin-top: 20px; /* set up the top margin */
        }
        table {
            border-collapse: collapse;
            width: 80%; /* table width adjestment */
            margin: 20px auto; /* set table into center allignment*/
            background-color: #fff; /* addin white  background */
            border-radius: 8px; /* shape  out the boearders */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* ading shadow */
        }
        th, td {
            border: 1px solid #ddd; /* Lighten border color */
            padding: 12px; /* enhansing the padding */
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9; /* changing row colors row by row*/
        }
        a {
            display: block; /* Converting inline link to block */
            text-align: center; /* set link to Center align */
            margin-top: 20px; /* Adding some top margin */
            text-decoration: none; /* Remove underline part of the link */
            color: #007bff; /* Changing  link color */
        }
        a:hover {
            color: #0056b3; /* Changing the link color on hover */
        }
    </style>
</head>
<body>
    <h2>Book Categories</h2>
    <table>
        <thead>
            <tr>
                <th>Category ID</th>
                <th>Category Name</th>
                <th>Date Modified</th>
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
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No categories found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="manage_book_category.php">Update Book Categories</a>
    <a href="addbookcategory.php">Insert Categories</a>
    <a href="admin.php">Admin Page</a>
</body>
</html>

<?php
// Close database connection
$conn->close();
?>
