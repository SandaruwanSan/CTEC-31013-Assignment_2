<?php

include 'db_connection.php';
date_default_timezone_set('Asia/Colombo');


function addBorrowDetails($borrowID, $bookID, $memberID, $borrowStatus, $modifiedDate) {
    global $conn;
    $sql = "INSERT INTO bookborrower (borrow_id, book_id, member_id, borrow_status, borrower_date_modified) VALUES ('$borrowID', '$bookID', '$memberID', '$borrowStatus', '$modifiedDate')";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}


function updateBorrowDetails($borrowID, $bookID, $borrowStatus, $modifiedDate) {
    global $conn;
    $sql = "UPDATE bookborrower SET book_id='$bookID', borrow_status='$borrowStatus', borrower_date_modified='$modifiedDate' WHERE borrow_id='$borrowID'";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}


function deleteBorrowDetails($borrowID) {
    global $conn;
    $sql = "DELETE FROM bookborrower WHERE borrow_id='$borrowID'";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Handle form submissions
if(isset($_POST['add_borrow'])) {
   
    $borrowID = $_POST['borrow_id'];
    $bookID = $_POST['book_id'];
    $memberID = $_POST['member_id'];
    $borrowStatus = $_POST['borrow_status'];
    $modifiedDate = date("Y-m-d H:i:s");


    if (!preg_match('/^BR\d{3}$/', $borrowID)) {
        echo "Error: Borrow ID should be in the format 'BR001'.";
    } elseif (!preg_match('/^B\d{3}$/', $bookID)) {
        echo "Error: Book ID should be in the format 'B001'.";
    } elseif (!preg_match('/^M\d{3}$/', $memberID)) {
        echo "Error: Member ID should be in the format 'M001'.";
    } else {
        
        if(addBorrowDetails($borrowID, $bookID, $memberID, $borrowStatus, $modifiedDate)) {
            echo "Borrow details added successfully.";
        } else {
            echo "Error adding borrow details.";
        }
    }
}

if(isset($_POST['update_borrow'])) {
    
    $borrowID = $_POST['borrow_id'];
    $bookID = $_POST['book_id'];
    $borrowStatus = $_POST['borrow_status'];
    $modifiedDate = date("Y-m-d H:i:s");



    
    if(updateBorrowDetails($borrowID, $bookID, $borrowStatus, $modifiedDate)) {
        echo "Borrow details updated successfully.";
    } else {
        echo "Error updating borrow details.";
    }
}

if(isset($_POST['delete_borrow'])) {
   
    $borrowID = $_POST['borrow_id'];

    
    if(deleteBorrowDetails($borrowID)) {
        echo "Borrow details deleted successfully.";
    } else {
        echo "Error deleting borrow details.";
    }
}


function getBorrowRecords() {
    global $conn;
    $sql = "SELECT * FROM bookborrower";
    $result = $conn->query($sql);
    return $result;
}
?>

