<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['id_user'])) {
    // If not authenticated, redirect to login page
    header("Location: login.html");
    exit();
}

$host = "localhost";
$dbname = "name-database";
$username = "useruname";
$password = "password";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error connecting to database, please try again" . $conn->connect_error);
}

$idUser = $_SESSION['id_user'];

// Customized query based on the same user id as the esp
$query = "SELECT * FROM table_name WHERE column_id_user = '$idUser'"; //access the information of that id
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // View user data
    while ($row = $result->fetch_assoc()) {
        $info1 =  $row["info1"];
        $info2 = $row["info2"];
        // database data
    }
} else {

}

$conn->close();
?>
<html>
 <head>

  <meta charset="utf-8">
    <title>Previw Page </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
  </head>
<body>
   
<!--update database -->
  <form action="" method="POST">    
    <button input type="submit" name="update" value="update" ><img class="som">update database</button>
  </form>
  <h1 >info1:</h1>
  <span><?= $info1 ?> </span>
  <h2>info2:</h2>
  <span><?= $info2 ?> </span>
    <?php
    if (isset($_POST['update'])) {
        // Execute the php page that will update the database
        include "update.php";
        exit();
    }
    ?>
</body>
</html>