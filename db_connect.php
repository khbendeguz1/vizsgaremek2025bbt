<?php
// db_connect.php

$servername = "localhost";
$username = "autoberlo";
$password = "Szily2025";
$dbname = "autoberlo";

// Kapcsolódás létrehozása
$conn = new mysqli($servername, $username, $password, $dbname);

// Kapcsolat ellenőrzése
if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}
?>