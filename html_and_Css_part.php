<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Library Member Registration</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: space-between;
        background-color: #cce1f0;
    }

    .form-container {
        margin-right: 20px;
        margin-left: 20px;
        max-width: 300px;
        background-color: lightblue;
    }

    form {
        margin-bottom: 10px;
    }

    input[type="text"],
    input[type="email"],
    input[type="date"] {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }

    table {
        flex: 1;
        border-collapse: collapse;
        margin-top: 20px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    th, td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
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

<div class="form-container">
    <!-- HTML form for library member registration -->
    <form method="post" action="">
        <h2> Add Members </h2>
        Member ID: <input type="text" name="member_id" pattern="M\d{3}" title="Member ID should be in the format 'M001'"><br>
        Firstname: <input type="text" name="firstname"><br>
        Lastname: <input type="text" name="lastname"><br>
        Birthday: <input type="date" name="birthday"><br>
        Email: <input type="email" name="email"><br>
        <input type="submit" name="register_member" value="Register Member">
    </form>

    <!-- HTML form for updating library member details -->
    <form method="post" action="">
    <h2> Update Members </h2>
        Member ID: <input type="text" name="member_id"><br>
        Firstname: <input type="text" name="firstname"><br>
        Lastname: <input type="text" name="lastname"><br>
        Birthday: <input type="date" name="birthday"><br>
        Email: <input type="email" name="email"><br>
        <input type="submit" name="update_member" value="Update Member">
    </form>

    <!-- HTML form for deleting library member -->
    <form method="post" action="">
    <h2> Delete Members </h2>
        Member ID: <input type="text" name="member_id"><br>
        <input type="submit" name="delete_member" value="Delete Member">
        <div class='admin-link'>
        <a href='admin.php'>Admin Page</a>
    </div>
    </form>
</div>


<table>
<thead>
        <tr >
        
            <th colspan='5'><center><h2> Available Members</h2></center></th>
        </tr>
    </thead>
    
    <thead>
        <tr>
            <th>Member ID</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Birthday</th>
            <th>Email</th>
        </tr>
    </thead>

    <tbody>
    </tbody>
</table>

</body>
</html>