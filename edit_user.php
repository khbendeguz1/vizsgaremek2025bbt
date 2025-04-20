<?php
session_start();
require 'db_connect.php';

// Csak admin szerkeszthet!
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $username_input = $_POST['username'];
    $nev = $_POST['nev'];
    $jogositvany = $_POST['jogositvany_megszerzese'];
    $admin = $_POST['admin'];

    $sql = "UPDATE users 
            SET username = ?, nev = ?, jogositvany_megszerzese = ?, admin = ? 
            WHERE id = ?";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssii", $username_input, $nev, $jogositvany, $admin, $id);

    if ($stmt->execute()) {
        header("Location: add_car.php?success=1");
        exit();
    } else {
        echo "Hiba történt: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
