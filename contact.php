<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(270deg, #ff7eb3, #ff758c, #ff6a65, #ffb38a);
            background-size: 800% 800%;
            animation: gradientBG 10s ease infinite;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        nav {
            background-color:rgb(38, 41, 38);
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            color: white;
            
        }

        nav div {
            font-size: 24px;
            font-weight: bold;
            margin-left: 740px;
        }

        nav a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }

        nav a:hover {
            text-decoration: underline;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 50px auto;
            width: 80%;
            background-color: rgba(255, 255, 255, 0.8);
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            border-radius: 8px;
        }

        .form-section, .image-section {
            flex: 1;
        }

        .image-section img {
            width: 100%;
            height: 500px;
            border-radius: 8px;
            margin-left: 35px;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        form {
            width: 100%;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input, textarea {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            height: 100px;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            margin-top: 100px;
        }

        .message {
            text-align: center;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            margin-bottom: 20px;
        }

        .success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
<?php
session_start();

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    // Database connection variables
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "palm";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO contacts (name, email, phone, message) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $phone, $message);

    if ($stmt->execute()) {
        $_SESSION['success_message'] = "Message sent successfully!";
        header("Refresh: 3; URL=index.html");
    } else {
        $_SESSION['error_message'] = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<nav>
    <div>RekhaSutra</div>
   
</nav>

<div class="container">
    <div class="form-section">
        <h1>Contact Us</h1>

        <?php if (isset($_SESSION['success_message'])) { ?>
            <div class="message success"><?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?></div>
        <?php } elseif (isset($_SESSION['error_message'])) { ?>
            <div class="message error"><?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?></div>
        <?php } ?>

        <form action="" method="post">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" required>

            <label for="phone">Phone</label>
            <input type="text" id="phone" name="phone" required>

            <label for="message">Message</label>
            <textarea id="message" name="message" required></textarea>

            <button type="submit">Send Message</button>
        </form>
    </div>

    <div class="image-section">
        <img src="contact1.jpg" alt="Contact Us">
    </div>
</div>

<footer>
    <p>&copy; RekhaSutra</p>
</footer>

</body>
</html>
