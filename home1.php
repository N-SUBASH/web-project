<?php
session_start();

// Retrieve the email from the session
$email = isset($_SESSION['email']) ? $_SESSION['email'] : null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ICE CREAM PARLOUR</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f8ff; /* Light blue background */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        header {
            background-color: #333; /* Dark gray header */
            color: white;
            padding: 20px;
            width: 100%;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin: 0;
            font-size: 2.5rem;
            color: #4CAF50; /* Green color for the heading */
        }
        h2 {
            font-size: 1.5rem;
            color: #4CAF50; /* Green color for the subheading */
        }
        nav {
            margin-top: 10px;
        }
        nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
            font-size: 1.1rem;
        }
        nav a:hover {
            color: #4CAF50; /* Green color on hover */
        }
        .middle {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        footer {
            background-color: #333; /* Dark gray footer */
            color: white;
            padding: 10px;
            width: 100%;
            text-align: center;
            position: fixed;
            bottom: 0;
        }
        .welcome-message {
            background-color: rgba(255, 255, 255, 0.8); /* Semi-transparent white background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
    </style>
</head>
<body>
    <header>
        <h1>The Frozen Spoon</h1>
        <h2>"Register and start enjoying Yourself"</h2>
        <!-- Include hyperlinks from links.html -->
        <?php include 'links.html'; ?>
    </header>

    <div class="middle">
        <div class="welcome-message">
            <?php
            if ($email) {
                echo "<h2>Welcome, $email</h2>";
                echo "<p>This is Your Home Page</p>";
            } else {
                echo "<h2>You Successfully Logged Out</h2>";
            }
            ?>
        </div>
    </div>

    <footer>
        Copy Right @ Praneeth
    </footer>
</body>
</html>