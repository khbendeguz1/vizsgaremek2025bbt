<?php
// Adatbázis kapcsolati beállítások
$servername = "localhost";
$username = "autoberlo";
$password = "Szily2025";
$dbname = "autoberlo";

// Kapcsolódás az adatbázishoz
$conn = new mysqli($servername, $username, $password, $dbname);

// Ellenőrzés, hogy a kapcsolat sikeres volt-e
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
