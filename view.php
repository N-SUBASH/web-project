<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "SSS";

try {
    // Connect to MySQL database
    $conn = new mysqli($servername, $username, $password, $database);

    // Check connection
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Initialize variables
    $email = "";
    $userDetails = [];

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = trim($_POST["email"]);

        // Fetch user details based on email
        $sql = "SELECT sname, phno, email, password FROM student87 WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $userDetails = $result->fetch_assoc();
        } else {
            $errorMessage = "No user found with the provided email.";
        }

        $stmt->close();
    }

} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View User Details - The Frozen Spoon</title>
    <style>
        body {
            font-family: Calibri, Helvetica, sans-serif;
            background-image: url('https://w0.peakpx.com/wallpaper/702/688/HD-wallpaper-ice-cream-background-beautiful-best-available-for-ice-cream.jpg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        header {
            background-color: rgb(128, 128, 128);
            color: white;
            padding: 10px 0;
            font-size: 24px;
        }
        h1 {
            margin: 0;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 60vh; /* Adjusted to move the form up */
            padding: 20px;
        }
        .cont1 {
            padding: 20px;
            color: #03072C;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 5px;
            width: 400px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        input[type="email"] {
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.8);
            color: black;
            margin-bottom: 10px;
        }
        input[type="email"]:focus {
            outline: none;
            background-color: rgba(255, 255, 255, 1);
        }
        .viewbtn {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            border: none;
            cursor: pointer;
            width: 100%;
            border-radius: 5px;
            font-size: 16px;
        }
        .viewbtn:hover {
            opacity: 0.8;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background: #007BFF;
            color: white;
        }
        tr:nth-child(even) {
            background: #f2f2f2;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        footer {
            background-color: rgb(128, 128, 128);
            color: white;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

<header>
    <h1><marquee>The Frozen Spoon</marquee></h1>
    <!-- Include hyperlinks from links.html -->
    <?php include 'links.html'; ?>
</header>

<div class="container">
    <div class="cont1">
        <h2>View User Details</h2>
        <form action="view.php" method="POST">
            <label for="email">Enter Email:</label>
            <input type="email" name="email" placeholder="Enter Email" required>
            <input type="submit" value="View Details" class="viewbtn">
        </form>

        <?php if (!empty($userDetails)): ?>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Password (Hashed)</th>
                </tr>
                <tr>
                    <td><?= $userDetails['sname'] ?></td>
                    <td><?= $userDetails['phno'] ?></td>
                    <td><?= $userDetails['email'] ?></td>
                    <td><?= $userDetails['password'] ?></td>
                </tr>
            </table>
        <?php elseif (isset($errorMessage)): ?>
            <p class="error"><?= $errorMessage ?></p>
        <?php endif; ?>
    </div>
</div>

<footer>
    Copy Right @ praneeth
</footer>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>