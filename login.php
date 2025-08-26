<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$database = "SSS";

try {
    // Create connection
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Ensure form is submitted using POST method
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Fetch form data
        $email = isset($_POST['email']) ? trim($_POST['email']) : '';
        $password = isset($_POST['password']) ? trim($_POST['password']) : '';

        // Validate inputs
        if (empty($email) || empty($password)) {
            echo "<script>alert('Both fields are required.'); window.location.href='login.html';</script>";
            exit();
        }

        // Prepare SQL query
        $sql = "SELECT * FROM student87 WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row['password']; // Plain text password
            
            // Debugging: Display entered and stored password
            echo "Entered Password: " . htmlspecialchars($password) . "<br>";
            echo "Stored Password: " . htmlspecialchars($stored_password) . "<br>";

            if ($password === $stored_password) { // Direct string comparison
                echo "Login successful! Redirecting...";
                $_SESSION['email'] = $email;
                header("Location: home1.php");
                exit();
            } else {
                echo "Incorrect password!";
            }
        } else {
            echo "Email not found!";
        }

        // Close statement
        $stmt->close();
    } else {
        throw new Exception("Invalid request method.");
    }

    $conn->close();

} catch (Exception $e) {
    echo "<script>alert('Error: " . addslashes($e->getMessage()) . "'); window.location.href='login.html';</script>";
}
?>
