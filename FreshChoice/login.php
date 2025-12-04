<?php 

session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: systeem-login.html");
    exit;
}

$email = trim($_POST['email']);
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['email'] = $user['email'];

        // 🔥 Redirect naar hoofdscherm.php
        header("Location: hoofdscherm.php");
        exit;
    } else {
        echo "Wachtwoord verkeerd!";
    }
} else {
    echo "Gebruiker niet gevonden!";
}
?>
