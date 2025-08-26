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

    // Fetch all users from the database
    $sql = "SELECT sname, phno, email, password FROM student87";

    $result = $conn->query($sql);

    if (!$result) {
        throw new Exception("Error fetching data: " . $conn->error);
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
    <title>View All Users - Ice Cream Parlour</title>
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
        h2 {
            color: #03072C;
        }
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            background: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
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
        .container {
            margin-top: 20px;
        }
        a {
            text-decoration: none;
            color: white;
            background: #28a745;
            padding: 10px;
            border-radius: 5px;
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
    <marquee>ICE CREAM PARLOUR</marquee>
    <!-- Include hyperlinks from links.html -->
    <?php include 'links.html'; ?>
</header>

<h2>Registered Users</h2>

<table>
    <tr>
        <th>Name</th>
        <th>Phone Number</th>
        <th>Email</th>
        <th>Password</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['sname']}</td>
                    <td>{$row['phno']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['password']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='5'>No users found</td></tr>";
    }
    ?>
</table>

<div class="container">
    <a href="home1.php">Go to Home</a>
</div>

<footer>
    copy right @ Praneeth
</footer>

</body>
</html>

<?php
// Close the database connection
$conn->close();
?>