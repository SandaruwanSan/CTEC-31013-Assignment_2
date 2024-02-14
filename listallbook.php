<?php
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


// Retrieve all books from the database
$sql = "SELECT * FROM book";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output table with CSS styles
    echo "<html>
<head>
    <title>Library System - Book List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        h1 {
            text-align: center;
            margin-top: 50px;
            color: #333;
        }
        table {
            margin: 50px auto;
            border-collapse: collapse;
            width: 80%;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f5f5f5;
        }
        tr:hover {
            background-color: #d8e7ff;
        }
        .admin-link {
            display: block;
            text-align: center;
            margin-top: 20px;
        }
        .admin-link a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <h1>Library System - Book List</h1>
    <table>
        <tr>
            <th>Book ID</th>
            <th>Book Name</th>
            <th>Category ID</th>
        </tr>";

    // Output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . $row["book_id"] . "</td>
                <td>" . $row["book_name"] . "</td>
                <td>" . $row["category_id"] . "</td>
              </tr>";
    }
    echo "</table><table><tr><td>
    <div class='admin-link'>
        <a href='admin.php'>Admin Page</a>
      
    </div></td> <td><div class='admin-link'><a href='insertbook.php' class='btn btn-info'>Insert Books</a></div></td><td>
    <div class='admin-link'>
    <a href='manage_books.php' class='btn btn-info'>Update Book List</a>
</div></td></tr></table>
    
</body>
</html>";
} else {
    echo "No books found.";
}

// Close connection
$conn->close();
?>
