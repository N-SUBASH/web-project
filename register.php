<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "SSS"; // Ensure this is the correct database name

try {
    // Connect to MySQL database
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Fetch form data
    $sname = isset($_POST['sname']) ? trim($_POST['sname']) : '';
    $phno = isset($_POST['phno']) ? trim($_POST['phno']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $cpassword = isset($_POST['cpassword']) ? $_POST['cpassword'] : '';

    // Validate inputs
    if (empty($sname) || empty($phno) || empty($email) || empty($password) || empty($cpassword)) {
        throw new Exception("All fields are required.");
    }

    // Check if passwords match
    if ($password !== $cpassword) {
        throw new Exception("Passwords do not match.");
    }

    // Check if email already exists
    $sql_check = "SELECT email FROM student87 WHERE email = ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result_check = $stmt_check->get_result();

    if ($result_check->num_rows > 0) {
        throw new Exception("Email already exists. Try logging in.");
    }

    $stmt_check->close();

    // Hash the password before storing it
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert data into database
    $sql = "INSERT INTO student87 (sname, phno, email, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        throw new Exception("SQL prepare failed: " . $conn->error);
    }

    // Bind parameters
    $stmt->bind_param("ssss", $sname, $phno, $email, $password);

    // Execute query
    if ($stmt->execute()) {
        echo "<script>alert('Registration successful!'); window.location.href='login.html';</script>";
    } else {
        throw new Exception("Error inserting data: " . $stmt->error);
    }

    // Close connections
    $stmt->close();
    $conn->close();

} catch (Exception $e) {
    echo "<script>alert('Error: " . addslashes($e->getMessage()) . "'); window.location.href='register.html';</script>";
}
?>
