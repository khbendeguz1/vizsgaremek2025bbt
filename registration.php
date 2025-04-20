<?php
session_start();
$conn = mysqli_connect("localhost", "autoberlo", "Szily2025", "autoberlo");

if (!$conn) {
    die("Adatbázis-kapcsolati hiba: " . mysqli_connect_error());
}

// Hibaüzenetek engedélyezése
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nev = $_POST["nev"];
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $email = $_POST["email"];
    $jogositvany_megszerzese = $_POST["jogositvany_megszerzese"];
    $jogositvany_szam = $_POST["jogositvany_szam"];

    // Felhasználónév ellenőrzése
    $check_username_query = $conn->prepare("SELECT id FROM users WHERE username = ?");
    $check_username_query->bind_param("s", $username);
    $check_username_query->execute();
    $result = $check_username_query->get_result();

    if ($result->num_rows > 0) {
        $error = "A felhasználónév már foglalt.";
    } else {
        // Adatok beszúrása
        $sql = $conn->prepare("INSERT INTO users (nev, username, password, email, jogositvany_megszerzese, jogositvany_szam) 
                               VALUES (?, ?, ?, ?, ?, ?)");
        $sql->bind_param("ssssss", $nev, $username, $password, $email, $jogositvany_megszerzese, $jogositvany_szam);

        if ($sql->execute()) {
            header("Location: login.php");
            exit();
        } else {
            $error = "Hiba történt a regisztráció során: " . $sql->error;
        }
    }

    // Lekérdezések bezárása
    $check_username_query->close();
    $sql->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Regisztráció</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: linear-gradient(135deg, #6a82fb, #fc5c7d);
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            font-family: 'Arial', sans-serif;
            color: white;
        }
        /* Navbar */
        .navbar {
            background: rgba(0, 0, 0, 0) !important;
            border: none;
        }
        .navbar-brand, .nav-link {
            color: white !important;
        }
        .navbar-toggler-icon {
            background-color: white;
        }
        .navbar-nav .nav-item.active .nav-link {
            color: #ff758c !important;
        }

        .container {
            max-width: 400px;
            background: rgba(0, 0, 0, 0.6);
            color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            animation: fadeIn 0.8s ease-in-out;
        }

        .form-group {
            text-align: left;
        }

        .btn-primary {
            background: #ff758c;
            border: none;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #ff5a7f;
        }

        .alert {
            background: #ff758c;
            color: white;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        

    </style>
</head>
<body>
    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">BBT Autóbérlő</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Főoldal</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="autok.php">Autók</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kapcsolat.php">Kapcsolat</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- REGISZTRÁCIÓS FORM -->
    <div class="container">
        <h2 class="mb-4">Regisztráció</h2>
        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php } ?>
        <form method="post">
            <div class="form-group">
                <label for="nev">Név:</label>
                <input type="text" class="form-control" id="nev" name="nev" required>
            </div>
            <div class="form-group">
                <label for="username">Felhasználónév:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Jelszó:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="email">E-mail cím:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="jogositvany_megszerzese">Jogosítvány megszerzésének dátuma:</label>
                <input type="date" class="form-control" id="jogositvany_megszerzese" name="jogositvany_megszerzese" required>
            </div>
            <div class="form-group">
                <label for="jogositvany_szam">Érvényes jogosítványának a száma:</label>
                <input type="text" class="form-control" id="jogositvany_szam" name="jogositvany_szam" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Regisztráció</button>
        </form>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
