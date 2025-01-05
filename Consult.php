<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer via Composer

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Palm";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Booking appointment
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $payment_status = "Pending";

    // Insert booking details into the database
    $sql = "INSERT INTO consultations (consultation_date, consultation_time, payment_status, name, email, phone) 
            VALUES ('$date', '$time', '$payment_status', '$name', '$email', '$phone')";

    


    if ($conn->query($sql) === TRUE) {
        // Send email
        $mail = new PHPMailer(true);

        try {
            // SMTP Configuration
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'rekhasutrabookings@gmail.com'; // Your Gmail address
            $mail->Password = 'qwwx esea vqvo nwhj';   // Your App Password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Sender and Recipient
            $mail->setFrom('rekhasutrabookings@gmail.com', 'Palmistry Consultation');
            $mail->addAddress($email, $name); // Send email to the user

            // Email Content
            $mail->isHTML(true);
            $mail->Subject = 'Appointment Confirmation';
            $mail->Body = "
                Hi $name,<br><br>
                Thank you for booking an appointment with us.<br><br>
                <strong>Appointment Details:</strong><br>
                Date: $date<br>
                Time: $time<br><br>
                To complete your payment of INR 399, use the following UPI link:<br>
                <a href='upi://pay?pa=example@upi&pn=Consultation&am=399&cu=INR'>Pay Now</a><br><br>
                Regards,<br>
                Palmistry Consultation Team
            ";

            // Send Email
            $mail->send();
            echo "Appointment booked successfully. A confirmation email has been sent to $email.";
        } catch (Exception $e) {
            echo "Error: Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}




$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
        }
        form h2 {
            text-align: center;
        }
        form input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        form input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        form input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <h2>Book an Appointment</h2>
        Name: <input type="text" name="name" required><br>
        Email: <input type="email" name="email" required><br>
        Phone: <input type="text" name="phone" required><br>
        Date: <input type="text" id="date" name="date" required><br>
        Time: <input type="text" id="time" name="time" required><br>
        <input type="submit" value="Book Appointment">
    </form>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>
    <script>
        $(function() {
            // Initialize Datepicker
            $("#date").datepicker({
                dateFormat: "yy-mm-dd",
                minDate: 0,
                showAnim: "slideDown"
            });

            // Initialize Timepicker
            $("#time").timepicker({
                timeFormat: 'h:i A',
                interval: 25,
                minTime: '8:00am',
                maxTime: '6:00pm',
                dynamic: false,
                dropdown: true,
                scrollbar: true
            });
        });
    </script>
</body>
</html>
