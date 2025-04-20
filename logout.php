<?php
session_start();

// Session változók törlése
unset($_SESSION["username"]);

// Session megsemmisítése
session_destroy();

// Átirányítás a bejelentkezési oldalra
header("Location: index.php");
exit();
?>