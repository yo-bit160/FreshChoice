<?php
header("Content-Type: application/json");
$conn = new mysqli("localhost", "root", "", "dashboard");

$result = $conn->query("SELECT * FROM voorraad");
$data = [];

while($row = $result->fetch_assoc()){
    $data[] = $row;
}

echo json_encode($data);
?>
