<?php
session_start();
include 'db.php';

$email = $_POST['email'];
$password = $_POST['password'];
$role = $_POST['role'];

$hashed = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (email, password, role) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $email, $hashed, $role);

if ($stmt->execute()) {
    echo "account_created";
    header("Location: systeem-login.html");
    exit;
} else {
    echo "error: " . $conn->error;
}
?>
