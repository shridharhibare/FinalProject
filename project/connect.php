<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pet";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullName = $_POST["fullName"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];

    // Prepare SQL statement
    $sql = "INSERT INTO users (fullName, email, phone, password) VALUES ('$fullName', '$email', '$phone', '$password')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful!";
        // Redirect to another page after successful registration
        header("Location: login.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
