<?php
session_start();

$host = "localhost";
$dbname = "name-database";
$username = "useruname";
$password = "password";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Database connection error: " . $conn->connect_error);
}

// Get form data
$username1 = $_POST['username']; //variable to store the form username
$password = $_POST['password']; //variable to store the form password

// checking the credentials in the database
$query = "SELECT * FROM table_name WHERE column_username = '$username1' AND column_password = '$password'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    // successful authentication
    $row = $result->fetch_assoc();
    $_SESSION['id_user'] = $row['Id_user']; //session variable to authenticate with esp

    // redirect to preview page
    header("Location: preview_page.php");
} else {
    // Invalid credentials, redirect back to login page
    header("Location: login.html");
}

$conn->close();
?>
