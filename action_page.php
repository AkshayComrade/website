<?php
// Database connection
$servername = "localhost";
$username = "2100031105cseh@gmail.com"; // Your MySQL username
$password = "Akshay@0712"; // Your MySQL password
$dbname = "gym_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Validate and retrieve form data
if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['mobile']) && isset($_POST['offers'])) {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $mobile = $conn->real_escape_string($_POST['mobile']);
    $offer = $conn->real_escape_string($_POST['offers']);

    // Debug form data
    echo "Form submitted<br>";
    echo "Name: " . $name . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Mobile: " . $mobile . "<br>";
    echo "Offer: " . $offer . "<br>";

    // Insert data into database
    $sql = "INSERT INTO registrations (name, email, mobile, offer) VALUES ('$name', '$email', '$mobile', '$offer')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Please fill in all the form fields!";
}

try {
    // Your connection and logic code here

    // Add basic error logging to check what went wrong
    if ($conn->connect_error) {
        throw new Exception("Connection failed: " . $conn->connect_error);
    }

    // Your SQL query and insertion logic
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

phpinfo();

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "Connected successfully";
}

$conn->close();
?>
