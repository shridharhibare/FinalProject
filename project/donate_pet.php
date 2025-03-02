<?php
// Database connection
$host = "localhost";
$user = "root"; // Change if needed
$password = ""; // Change if needed
$database = "pet"; // Change as per your database

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handling form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $email = $conn->real_escape_string($_POST['email']);
    $address = $conn->real_escape_string($_POST['address']);
    
    // Ensure petType is an array before using implode
    $petType = isset($_POST['petType']) ? (is_array($_POST['petType']) ? implode(", ", $_POST['petType']) : $_POST['petType']) : '';

    $breed = $conn->real_escape_string($_POST['breed']);
    $age = (int) $_POST['age'];
    $quantity = (int) $_POST['quantity'];
    $health = $conn->real_escape_string($_POST['health']);

    // Insert query
    $sql = "INSERT INTO pet_donations (name, phone, email, address, pet_type, breed, age, quantity, health)
            VALUES ('$name', '$phone', '$email', '$address', '$petType', '$breed', $age, $quantity, '$health')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Pet donation details submitted successfully!'); window.location.href='donate.html';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
