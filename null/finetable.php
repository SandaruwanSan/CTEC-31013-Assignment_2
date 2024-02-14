<?php 
require_once("config.php");
require_once("process.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <meta charset="UTF-8">
       <title>Assign Fine</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
        }
        input[type="text"], input[type="number"], input[type="datetime-local"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

            input[type="button"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .form-group {
        margin-bottom: 15px;
        text-align: left; 
    }


    .form-group_1{
        margin-bottom: 15px;
        text-align: left; 
        display: flex;
        justify-content: space-between;
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
    <div class="container">
        <h2>Assign Fine</h2>
        <form action="fine_sub.php" method="post">
            <div class="form-group">
                <label for="fineID">Fine ID:</label>
                <input type="text" id="fine_id" name="fine_id" required>
            </div>
            <div class="form-group">
                <label for="memberID">Member ID:</label>
                <input type="text" id="member_id" name="member_id" required>
            </div>
            <div class="form-group">
                <label for="bookID">Book ID:</label>
                <input type="text" id="book_id" name="book_id" required>
            </div>
            <div class="form-group">
                <label for="fineAmount">Fine Amount (LKR):</label>
                <input type="number" id="fine_amount" name="fine_amount" min="2" max="500" required>
            </div>
            <div class="form-group">
                <label for="dateModified">Date Modified:</label>
                <input type="datetime-local" id="fine_date_modified" name="fine_date_modified" required>
            </div>
            <div class="form-group_1">
                <input type="submit" value="Assign Fine">
        
                <a href="fine_sub.php"><input type="button" value="View"></a>

            </div>

        </form>
    </div>



</body>
</html>

