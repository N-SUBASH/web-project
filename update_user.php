<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbase = "SSS"; // Your database name

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbase);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Get form data
$email = mysqli_real_escape_string($conn, $_POST['email']);
$sname = mysqli_real_escape_string($conn, $_POST['sname']);
$phno = mysqli_real_escape_string($conn, $_POST['phno']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Update query with correct column names
$sql = "UPDATE student87 SET sname = '$sname', phno = '$phno', password = '$password' WHERE email = '$email'";

if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
} else {
    echo "Error updating record: " . mysqli_error($conn);
}

// Close the connection
mysqli_close($conn);
?>