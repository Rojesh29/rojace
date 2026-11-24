<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$Name = $_POST['Name'] ?? '';
$Email = $_POST['Email'] ?? '';
$Subject = $_POST['Subject'] ?? '';
$Message = $_POST['Message'] ?? '';

$conn = new mysqli("localhost", "root", "", "portfolio");

if ($conn->connect_error) {
    die("Database Connection Failed: " . $conn->connect_error);
}

$sql = "INSERT INTO contact (Name, Email, Subject, Message) VALUES (?, ?, ?, ?)";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("ssss", $Name, $Email, $Subject, $Message);

if ($stmt->execute()) {
    echo "Your message has been sent successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

?>