<?php 

require_once("config.php");
require_once("process.php");
require_once("delete.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
   
    <title>Assign Fine</title>

    <style>
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }

    th {
        background-color: #4CAF50;
        color: white;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tr:hover {
        background-color: #ddd;
    }

    .action-btn {
        padding: 8px 12px;
        background-color: #008CBA;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    .action-btn:hover {
        background-color: #005F6B;
    }
</style>






</head>
<body>
    <section>
        <nav>
            <div class="logo">
                <img src="image/logo.png" style="width: 60px; height: auto;" >
            </div>
            <ul>
                <li><a href="#Home">Home</a></li>
                <li><a href="#Book_reg">Book Registration</a></li>
                <li><a href="#Book_cat">Book Category</a></li>
                <li><a href="#Member">Member</a></li>
                <li><a href="#Book_borrow_deta">Book Borrow Details</a></li>
                <li><a href="#Fine">Fine</a></li>
            </ul>
            <div class="social_icon">
                <i class="fa-solid fa-magnifying-glass"></i>
                <i class="fa-solid fa-heart"></i>
                <i class="fa-solid fa-envelope"></i>
            </div>
        </nav>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>

        <?php
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
            
            $sql = "SELECT f.fine_id, f.member_id, m.first_name, b.book_name, f.fine_amount, f.fine_date_modified 
                    FROM fine f 
                    JOIN book b ON f.book_id = b.book_id 
                    JOIN member m ON f.member_id = m.member_id";
            $result = $conn->query($sql);

            // Check if we have results
            if ($result->num_rows > 0) {
                // Start the table
                echo "<table>";
                echo "<tr><th>Fine ID</th><th>Member ID</th><th>Member Name</th><th>Book Name</th><th>Fine Amount (LKR)</th><th>Date Modified</th><th>Action</th></tr>";
                
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["fine_id"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["member_id"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["first_name"]) . "</td>"; 
                    echo "<td>" . htmlspecialchars($row["book_name"]) . "</td>";   
                    echo "<td>" . htmlspecialchars($row["fine_amount"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["fine_date_modified"]) . "</td>";

                    // Create a form for deleting the fine
                    echo "<td>
                    <form action='delete.php' method='get'>
                    <input type='hidden' name='fine_id' value='" . htmlspecialchars($row['fine_id']) . "'>
                    <input type='submit' value='Delete'>
                </form>
                        </td>";
                    echo "</tr>";
                }
                
                echo "</table>";
            } else {
                echo "0 results";
            }
            $conn->close();
        ?>
    </section>
</body>
</html>
