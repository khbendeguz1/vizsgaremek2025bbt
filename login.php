<?php
session_start();
$conn = mysqli_connect("localhost", "autoberlo", "Szily2025", "autoberlo");

// Hibák megjelenítése fejlesztés közben
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // SQL injekció ellen védett lekérdezés
    $stmt = $conn->prepare("
        SELECT id, username, password, nev, jogositvany_szam, admin 
        FROM users 
        WHERE username = ?
    ");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        // Session változók beállítása
        $_SESSION["user_id"] = $user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["nev"] = $user["nev"];
        $_SESSION["jogositvany_szam"] = $user["jogositvany_szam"];
        $_SESSION["admin"] = $user["admin"]; // FONTOS: Admin jog beállítása!

        // Átirányítás jogosultság szerint
        if ($user["admin"] == 1) {
            header("Location: add_car.php"); // Admin felület
        } else {
            header("Location: welcome.php"); // Felhasználói felület
        }
        exit();
    } else {
        $error = "Hibás felhasználónév vagy jelszó.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #6a82fb, #fc5c7d);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
            color: white;
        }
        .container {
            max-width: 400px;
            background: rgba(0, 0, 0, 0.4);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.3);
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        h2 { color: #fff; }
        .form-group { text-align: left; margin-bottom: 20px; }
        .btn-primary {
            background: #ff758c;
            border: none;
            transition: 0.3s;
            padding: 12px 30px;
            border-radius: 25px;
        }
        .btn-primary:hover { background: #ff5a7f; }
        .alert { margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h2 class="mb-4">Bejelentkezés</h2>

        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>

        <form method="post">
            <div class="form-group">
                <label for="username">Felhasználónév:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Jelszó:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Bejelentkezés</button>
            <a class="btn btn-primary btn-block" href="registration.php" role="button">Regisztráció</a>    
        </form>
    </div>
</body>
</html>
