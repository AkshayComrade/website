<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "Akshay@0712"; // Replace with your password
$dbname = "gym_database";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {
    // Capture form data
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
    $amount = isset($_POST['amount']) ? $_POST['amount'] : '';


    // Insert data into the table
    $sql = "INSERT INTO registrations (name, email, mobile, offer) VALUES ('$name', '$email', '$mobile', '$amount')";
    if ($conn->query($sql) === TRUE) {
        $message = "Registration successful!";
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data for confirmation
    $name = htmlspecialchars(isset($_POST['name']) ? $_POST['name'] : '');
    $email = htmlspecialchars(isset($_POST['email']) ? $_POST['email'] : '');
    $mobile = htmlspecialchars(isset($_POST['mobile']) ? $_POST['mobile'] : '');
    $amount = htmlspecialchars(isset($_POST['amount']) ? $_POST['amount'] : 'No offer selected');

// Map the amounts to readable offers
    $offers = [
        "2000" => "1 Month - 2000",
        "4000" => "2 Months - 4000",
        "6000" => "3 Months - 6000",
        "4000_special" => "4 Months - 4000 (Special Offer)",
        "6000_special" => "6 Months - 6000 (Special Offer)",
        "14000" => "7 Months - 14000",
        "16000" => "8 Months - 16000",
        "18000" => "9 Months - 18000",
        "20000" => "10 Months - 20000",
        "22000" => "11 Months - 22000",
        "8000" => "12 Months - 8000 (Special Offer)"
    ];
    $selectedOffer = isset($offers[$amount]) ? $offers[$amount] : "No offer selected";


    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <h1>Welcome tenali biggest gym </h1>
        <title>confirm your details</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                text-align: center;
                margin-top: 50px;
            }
            h1 {
                color: #333;
            }
            .details {
                font-size: 18px;
                margin: 20px 0;
            }
            .button {
                padding: 10px 20px;
                font-size: 16px;
                background-color: rgba(184, 0, 0, 0.82);
                color: rgb(255, 255, 255);
                border: none;
                cursor: pointer;
                border-radius: 5px;
            }
            .button:hover {
                background-color: rgb(53, 172, 11);
            }
        </style>
    </head>
    <body>
    <h1>Confirm Your Details</h1>
    <p class="details"><strong>Name:</strong> <?php echo $name; ?></p>
    <p class="details"><strong>Email:</strong> <?php echo $email; ?></p>
    <p class="details"><strong>Mobile:</strong> <?php echo $mobile; ?></p>
    <p class="details"><strong>Selected Offer:</strong> <?php echo $selectedOffer; ?></p>
    <form method="POST" action="process.php">
        <input type="hidden" name="name" value="<?php echo $name; ?>">
        <input type="hidden" name="email" value="<?php echo $email; ?>">
        <input type="hidden" name="mobile" value="<?php echo $mobile; ?>">
        <input type="hidden" name="amount" value="<?php echo $amount; ?>">
        <button type="submit" name="confirm" class="button">Confirm and Proceed to Payment</button>
    </form>
    </body>
    </html>

    <?php
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Complete UPI Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 50px;
        }
        h1 {
            color: #333;
        }
        .message {
            font-size: 16px;
            margin-top: 20px;
            color: rgba(244, 9, 9, 0.76);
        }
    </style>
</head>
<body>
<h1>Complete Payment</h1>
<p class="message"><?php echo htmlspecialchars($message); ?></p>
<img src="images/qr.jpg" alt="UPI QR Code" width="300">
<br>
<a href="upi://pay?pa=2100031105cseh@oksbi&pn=Chandu's Gym&am=100&tn=Gym Membership Payment&cu=INR" target="_blank">Click here to Pay via UPI</a>
</body>
</html>
