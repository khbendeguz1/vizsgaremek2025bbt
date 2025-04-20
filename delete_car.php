<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
require 'db_connect.php';

// Csak admin törölhet!
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION["username"];
$stmt = $conn->prepare("SELECT admin FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($isAdmin);
$stmt->fetch();
$stmt->close();

if ($isAdmin != 1) {
    header("Location: welcome.php");
    exit();
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $id = intval($_GET['id']); // biztonságosabb

    $stmt = $conn->prepare("DELETE FROM cars WHERE id = ?");
    
    if ($stmt === false) {
        die("Hiba az előkészítés során: " . $conn->error);
    }

    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: add_car.php?deleted=1");
        exit();
    } else {
        echo "Hiba a törlés közben: " . $stmt->error;
    }

    $stmt->close();

} else {
    echo "Érvénytelen vagy hiányzó ID!";
}

$conn->close();
?>
