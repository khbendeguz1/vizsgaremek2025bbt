<?php
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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: add_car.php?deleted=1");
        exit();
    } else {
        echo "Hiba történt: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
