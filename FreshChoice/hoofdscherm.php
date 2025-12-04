<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: systeem-login.html");
    exit;
}

$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="Hoofdscherm aanwezigheid.css">
</head>
<body>
<div class="bovenkant">
    <div class="Welkom">
        <h1>Welkom, <?php echo htmlspecialchars($email); ?></h1>
    </div> 
    <div class="pfp-div">
        <img src="pfp3.png" class="pfp" alt="">
    </div>
</div>

<div class="schermen">
    <div class="kalender">
        kalender voor je beschikbaarheid
    </div>
    <div class="diensten">
        scherm voor je opkomende diensten
    </div>
</div>
</body>
</html>
