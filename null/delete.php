<?php
include 'config.php'; // Include your database connection file here

if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['fine_id'])) {
    // Validate the fine_id parameter
    $fine_id = $_GET['fine_id'];
    if (is_numeric($fine_id)){
        echo "Invalid fine ID";
        exit; // Stop script execution
    }else{

    // Prepare and execute the deletion query
    $sql = "DELETE FROM fine WHERE fine_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $fine_id);    // Assuming fine_id is an integer
    if ($stmt->execute()) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} 
}
?>
