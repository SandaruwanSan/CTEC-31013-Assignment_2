<?php
// Include database connection
include 'db_connection.php';

// Function to validate email format
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate Member ID format
function validateMemberID($memberID) {
    return preg_match('/^M\d{3}$/', $memberID);
}

// Function to retrieve library member details
function getMemberDetails($memberID) {
    global $conn;
    $sql = "SELECT * FROM member WHERE member_id='$memberID'";
    $result = $conn->query($sql);
    return $result->fetch_assoc();
}

// Function to retrieve all library members
function getAllMembers() {
    global $conn;
    $sql = "SELECT * FROM member";
    $result = $conn->query($sql);
    return $result;}

// Function to add new library member
function addMember($memberID, $firstname, $lastname, $birthday, $email) {
    global $conn;
    $sql = "INSERT INTO member (member_id, first_name, last_name, birthday, email) VALUES ('$memberID', '$firstname', '$lastname', '$birthday', '$email')";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Function to update library member details
function updateMember($memberID, $firstname, $lastname, $birthday, $email) {
    global $conn;
    $sql = "UPDATE member SET first_name='$firstname', last_name='$lastname', birthday='$birthday', email='$email' WHERE member_id='$memberID'";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

// Function to delete library member
function deleteMember($memberID) {
    global $conn;
    $sql = "DELETE FROM member WHERE member_id='$memberID'";
    if ($conn->query($sql) === TRUE) {
        return true;
    } else {
        return false;
    }
}

$members = getAllMembers();
// Check if form is submitted for registration


if(isset($_POST['register_member'])) {
    $memberID = $_POST['member_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];

    if (validateMemberID($memberID) && validateEmail($email)) {
        if(addMember($memberID, $firstname, $lastname, $birthday, $email)) {
            echo "Library member registered successfully.";
            header('Location:addmembers.php');
        } else {
            echo "Error registering library member.";
        }
    } else {
        echo "Member ID or Email address is invalid.";
    }
}

// Check if form is submitted for update
if(isset($_POST['update_member'])) {
    $memberID = $_POST['member_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $birthday = $_POST['birthday'];
    $email = $_POST['email'];

    if (validateEmail($email)) {
        if(updateMember($memberID, $firstname, $lastname, $birthday, $email)) {
            echo "Library member details updated successfully.";
            header('Location:addmembers.php');
        } else {
            echo "Error updating library member details.";
        }
    } else {
        echo "Email address is invalid.";
    }
}

// Check if form is submitted for deletion
if(isset($_POST['delete_member'])) {
    $memberID = $_POST['member_id'];
    if(deleteMember($memberID)) {
        echo "Library member deleted successfully.";
        header('Location:addmembers.php');
    } else {
        echo "Error deleting library member.";
    }
}
?>