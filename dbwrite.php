<?php

$host = "localhost";
$dbname = "name-database";
$username = "useruname";
$password = "password";


// Establish connection to MySQL database
$conn = new mysqli($host, $username, $password, $dbname);

// Check if connection established successfully
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// If values sent by NodeMCU are not empty, then insert into MySQL database table
if (!empty($_POST['sendva1']) && !empty($_POST['sendva2']) && !empty($_POST['sendId'])) {
    $info1 = $_POST['sendva1'];
    $info2 = $_POST['sendva2'];
    $id = $_POST['sendId'];

    // Retrieve the previous value of 'girar' column
    $send_esp = '';
    $query = "SELECT column_send_esp FROM table_name WHERE column_id_user = '$id'";
    $result = $conn->query($query);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $send_esp = $row['column_send_esp'];
    }

    // Update your tablename here
    $sql = "UPDATE table_name SET column_info1 = 'info1' WHERE column_id_user = '$id';
    UPDATE table_name SET column_info2 = 'info2' WHERE column_id_user = '$id';";

    if ($conn->multi_query($sql) === TRUE) {
        http_response_code(200);
        header('Content-Type: text/plain');
        echo  $previousGirarValue;
        echo $previousSomValue;
    } else {
        echo "Error updating data: " . $conn->error;
    }
}

// Close MySQL connection
$conn->close();

?>