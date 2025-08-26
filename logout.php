<?php
session_start(); // Start the session

// Invalidate the session (log out the user)
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout</title>
    <link rel="stylesheet" href="style12.css">
    <style>
        .container {
            background-image: url('https://images.pexels.com/photos/1362534/pexels-photo-1362534.jpeg?cs=srgb&dl=pexels-teejay-1362534.jpg&fm=jpg');
            background-size: cover;
            background-position: center;
            padding: 20px;
            min-height: calc(100vh - 160px);
            position: relative;
            color: white; 
        }
        .message-container {
            background-color: rgba(0, 0, 0, 0.5);  
            padding: 20px;
            border-radius: 10px;
            max-width: 400px;
            margin: auto;
        }
    </style>
</head>
<body>
    <header>
        <h1 align="center">The Frozen Spoon</h1>
        <ul class="navbar">
            <li><a href="home1.php">HOME</a></li>
        </ul>
    </header>
    <section>
        <div class="container">
            <div class="message-container">
                <center>
                    <h1>Logout</h1>
                    <p>You have been successfully logged out.</p>
                    <p><a href="login.php" style="color: #fff;">Login again</a></p>
                </center>
            </div>
        </div>
        <footer style="text-align: center;">
            Copy Right @Praneeth
        </footer>
    </section>
</body>
</html>