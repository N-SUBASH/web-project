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

// Get email from POST request
$email = mysqli_real_escape_string($conn, $_POST['email']);

// Query to fetch user details
$sql = "SELECT * FROM student87 WHERE email = '$email'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $response = [
        "status" => "success",
        "data" => [
            "name" => $row['name'], // Match column name
            "phone" => $row['phone'], // Match column name
            "password" => $row['password'] // Match column name
        ]
    ];
} else {
    $response = [
        "status" => "error",
        "message" => "No user found with the provided email."
    ];
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);

// Close the connection
mysqli_close($conn);
?>