<?php
// Database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbase = "SSS"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbase);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    
    if (!empty($email)) {
        // Use the correct table name: student87
        $sql = "DELETE FROM student87 WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $message = "Record deleted successfully.";
            } else {
                $message = "No record found with this email.";
            }
        } else {
            $message = "Error deleting record: " . $conn->error;
        }
        
        $stmt->close();
    } else {
        $message = "Please enter an email.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Calibri, Helvetica, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        .cont1 {
            padding: 50px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            margin-top: 20px;
        }

        input[type="email"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #f44336;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #d32f2f;
        }

        .links-container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 80%;
            max-width: 600px;
            margin-bottom: 20px;
        }

        .links-container h3 {
            margin-bottom: 15px;
            color: #03072C;
        }

        .links-container ul {
            list-style-type: none;
            padding: 0;
        }

        .links-container ul li {
            margin: 10px 0;
        }

        .links-container ul li a {
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }

        .links-container ul li a:hover {
            color: #45a049;
        }

        .message {
            color: green;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="links-container">
            <?php include 'links.html'; ?>
        </div>

        <div class="cont1">
            <form action="" method="POST">
                <label for="email">Enter Email to Delete Record:</label>
                <input type="email" id="email" name="email" placeholder="Enter Email" required>
                <input type="submit" value="Delete Record">
            </form>
            <?php if (!empty($message)) { echo "<p class='message'>$message</p>"; } ?>
        </div>
    </div>
</body>
</html>