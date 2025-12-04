<?php
// db.php — geen output, alleen connectie
$host = "localhost";
$user = "root";
$pass = "";
$db = "supermarkt_systeem";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    // fatale fout, geef duidelijke melding
    die("DB connect error: " . $conn->connect_error);
}
?>
