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

// Process login form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Check if user exists
    $sql = "SELECT id, fullName, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
}
    if ($result->num_rows === 1) { {
        $row = $result->fetch_assoc();
        if ($password == $row["password"]) {  // Compare plain text password
            // Login successful
            $_SESSION["user_id"] = $row["id"];
            $_SESSION["fullName"] = $row["fullName"];
            header("Location: index.html"); // Redirect to homepage
            exit();
        } else {
            echo "<script>alert('Invalid password!'); window.location.href='login.html';</script>";
        }
        }
    $stmt->close();
}
$conn->close();
?>
