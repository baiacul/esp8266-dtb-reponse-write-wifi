<?php

$host = "localhost";
$dbname = "name-database";
$username = "useruname";
$password = "password";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error connecting to database " . $conn->connect_error);
}

// Verify that the user ID is present in the session
if (!isset($_SESSION['id_user'])) {
    echo "ID user not found.";
    exit();
}

$id_user = $_SESSION['id_user'];

// Variable to be updated
$newValue = "newValue";

// SQL query to update variable
$sql = "UPDATE table_name SET send_esp = '$newValue' WHERE column_id_user = '$id_user' ";
 
if ($conn->query($sql) === TRUE) {
    
} else {
    echo "Error updating variable: " . $conn->error;
}

$conn->close();
?>