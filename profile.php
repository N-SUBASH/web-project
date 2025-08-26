<?php
session_start();

// Redirect if not logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$database = "SSS";

// Connect to MySQL database
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get user email from session
$email = $_SESSION['email'];

// Fetch user details (excluding password)
$sql = "SELECT sname, phno, email,password FROM student87 WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Close connection
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <link rel="stylesheet" href="styles1.css">
    <style>
        body {
            font-family: Calibri, Helvetica, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .container {
            width: 50%;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px gray;
            margin-top: 30px;
            flex-grow: 1;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background: #4CAF50;
            color: white;
        }
        .logout {
            background: red;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }
        .logout:hover {
            background: darkred;
        }
        .links-container {
            text-align: center;
            margin-top: 20px;
        }
        footer {
            text-align: center;
            background: gray;
            color: white;
            padding: 10px;
            margin-top: auto;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header style="background-color:gray; text-align:left; padding: 10px;">
        <h1 style="color:blue;font-family: 'Bold';"><marquee>ICE CREAM PARLOUR</marquee></h1>
    </header>

    <!-- Links in the middle of the page -->
    <div class="links-container">
        <?php include 'links.html'; ?>
    </div>

    <!-- User Profile -->
    <div class="container">
        <h1>User Profile</h1>
        <?php if ($user): ?>
            <table>
                <tr>
                    <th>Full Name</th>
                    <td><?= htmlspecialchars($user['sname']) ?></td>
                </tr>
                <tr>
                    <th>Phone Number</th>
                    <td><?= htmlspecialchars($user['phno']) ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                </tr>
                <tr>
                    <th>password</th>
                    <td><?= htmlspecialchars($user['password']) ?></td>
                </tr>
            </table>
        <?php else: ?>
            <p>User not found.</p>
        <?php endif; ?>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <!-- Footer at the bottom -->
    

</body>
</html>
