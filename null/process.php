<?php
// Check if the form has been submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect post data
    $fine_id = $_POST['fine_id'];
    $member_id = $_POST['member_id'];
    $book_id = $_POST['book_id'];
    $fine_amount = $_POST['fine_amount'];
    $fine_date_modified = $_POST['fine_date_modified']; // Make sure this date is in a format that your database expects (usually Y-m-d H:i:s)

    // Database connection parameters
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "library";

    try {
        
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare SQL statement
        $stmt = $conn->prepare("INSERT INTO fine (fine_id, member_id, book_id, fine_amount,fine_date_modified) VALUES (:fine_id, :member_id, :book_id, :fine_amount, :fine_date_modified)");

        // Bind parameters
        $stmt->bindParam(':fine_id', $fine_id);
        $stmt->bindParam(':member_id', $member_id);
        $stmt->bindParam(':book_id', $book_id);
        $stmt->bindParam(':fine_amount', $fine_amount);
        $stmt->bindParam(':fine_date_modified', $fine_date_modified);

        // Execute the prepared statement
        $stmt->execute();

        echo "New fine assigned successfully";
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    // Close connection
    $conn = null;
}
?>