
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background: linear-gradient(135deg, #6a82fb, #fc5c7d) repeat;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: 'Arial', sans-serif;
            color: white;
            overflow-y: auto;
        }

        .message-container {
            background: rgba(0, 0, 0, 0.7); /* áttetsző fekete háttér */
            padding: 40px;
            text-align: center;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            margin-top: 50px;
            max-width: 600px;
            width: 100%;
        }

        h1.sikeres {
            font-size: 3rem;
            margin-bottom: 15px;
            color: #fff;
        }

        p {
            font-size: 1.4rem;
            margin-bottom: 30px;
            color: #fff;
        }

        .btn-custom {
            display: inline-block;
            padding: 15px 30px;
            background-color: #fc5c7d;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
            text-decoration: none;
            border-radius: 50px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-custom:hover {
            background-color: #6a82fb;
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.3);
            transform: translateY(-3px);
        }

        .btn-custom:active {
            background-color: #fc5c7d;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
            transform: translateY(3px);
        }
        .star-rating {
    direction: rtl;
    display: inline-flex;
}

.star-rating input {
    display: none;
}

.star-rating label {
    font-size: 2rem;
    color: #444;
    cursor: pointer;
}

.star-rating input:checked ~ label {
    color: gold;
}

.star-rating label:hover,
.star-rating label:hover ~ label {
    color: gold;
}
    </style>
</head>
<body>
<div class='message-container'>
                <h1 class='sikeres'>Sikeres bérlés! 🎉</h1>
                <p>Köszönjük, hogy nálunk béreltél! 🎊</p>
                <section class="container mt-5">
    <h2 class="text-center text-white">Oszd meg a véleményed</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label class="text-white">Vélemény:</label>
            <textarea name="velemeny" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label class="text-white">Pozitívumok:</label>
            <input type="text" name="pro" class="form-control">
        </div>
        <div class="form-group">
            <label class="text-white">Negatívumok:</label>
            <input type="text" name="contra" class="form-control">
        </div>
        <div class="form-group">
            <label class="text-white d-block">Értékelés:</label>
            <div class="star-rating">
                <input type="radio" name="ertekeles" id="star5" value="5"><label for="star5">&#9733;</label>
                <input type="radio" name="ertekeles" id="star4" value="4"><label for="star4">&#9733;</label>
                <input type="radio" name="ertekeles" id="star3" value="3"><label for="star3">&#9733;</label>
                <input type="radio" name="ertekeles" id="star2" value="2"><label for="star2">&#9733;</label>
                <input type="radio" name="ertekeles" id="star1" value="1" required><label for="star1">&#9733;</label>
            </div>
        </div>
        <button type="submit" class="btn btn-success">Vélemény beküldése</button>
    </form>
</section>
</div>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    die("Nem vagy bejelentkezve.");
}

include("config.php"); // DB kapcsolat

$user_id = $_SESSION['user_id'];

// POST-ból érkező adatok biztonságosan
$auto_id = isset($_POST['auto_id']) ? intval($_POST['auto_id']) : 0;
$berles_kezdet = isset($_POST['berles_kezdet']) ? $_POST['berles_kezdet'] : '';
$berles_vege = isset($_POST['berles_vege']) ? $_POST['berles_vege'] : '';

// Validációk (lehet még bővíteni)
if ($auto_id === 0 || empty($berles_kezdet) || empty($berles_vege)) {
    die("Hiányzó adat(ok).");
}

// Lekérjük a user nevét, stb. (opcionális, de itt hasznos)
$query = "SELECT nev FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Felhasználó nem található.");
}

$user = $result->fetch_assoc();
$ugyfel_nev = $user['nev'];
$stmt->close();

// 1️⃣ Bérlés felvétele a berlesek táblába
$insertQuery = "INSERT INTO berlesek (auto_id, ugyfel_nev, berles_kezdete, berles_vege) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($insertQuery);
$stmt->bind_param("isss", $auto_id, $ugyfel_nev, $berles_kezdet, $berles_vege);

if ($stmt->execute()) {
    // 2️⃣ Opció: az autó státuszát is frissítjük, hogy berelve legyen
    $updateCar = "UPDATE cars SET berelve = 1 WHERE id = ?";
    $stmt2 = $conn->prepare($updateCar);
    $stmt2->bind_param("i", $auto_id);
    $stmt2->execute();
    $stmt2->close();

    ?>
 
    <?php
    // Ide mehet redirect pl.: header("Location: berlesek.php");
} else {
    echo "Hiba történt a bérlés mentése közben: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
</body>
</html>