<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id'])) {
    die("Nem vagy bejelentkezve.");
}

include("config.php");

$user_id = $_SESSION['user_id'];

// Felhasználói adatok lekérdezése
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Hibás felhasználói adatok.");
}

$user = $result->fetch_assoc();
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $auto_id = isset($_POST['auto_id']) ? intval($_POST['auto_id']) : 0;
    $berles_kezdet = isset($_POST['berles_kezdet']) ? $_POST['berles_kezdet'] : '';
    $berles_vege = isset($_POST['berles_vege']) ? $_POST['berles_vege'] : '';

    if ($auto_id === 0 || empty($berles_kezdet) || empty($berles_vege)) {
        die("Hiányzó adat(ok). Kérlek töltsd ki az űrlapot!");
    }

    if ($berles_kezdet >= $berles_vege) {
        die("A bérlés kezdete nem lehet későbbi vagy egyenlő a bérlés végével.");
    }

    // Autó árának lekérdezése és foglaltság ellenőrzése egyetlen lekérdezéssel
    $carQuery = "SELECT ar, berelve FROM cars WHERE id = ?";
    $stmt = $conn->prepare($carQuery);
    $stmt->bind_param("i", $auto_id);
    $stmt->execute();
    $carResult = $stmt->get_result();
    $stmt->close();

    if ($carResult->num_rows === 0) {
        die("Az autó nem található.");
    }

    $car = $carResult->fetch_assoc();
    if ($car['berelve'] == 1) {
        die("Ez az autó már bérbe van adva.");
    }

    $auto_ar = $car['ar'];
    $start_date = new DateTime($berles_kezdet);
    $end_date = new DateTime($berles_vege);
    $interval = $start_date->diff($end_date);
    $days = $interval->days;

    $total_price = $auto_ar * $days;
    $ugyfel_nev = $user['nev'];

    // Bérlés mentése és autó státusz frissítése egy tranzakcióban
    $conn->begin_transaction();
    
    try {
        $insertQuery = "INSERT INTO berlesek (auto_id, ugyfel_nev, berles_kezdete, berles_vege) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("isss", $auto_id, $ugyfel_nev, $berles_kezdet, $berles_vege);
        $stmt->execute();
        $stmt->close();

        $updateCar = "UPDATE cars SET berelve = 1 WHERE id = ?";
        $stmt2 = $conn->prepare($updateCar);
        $stmt2->bind_param("i", $auto_id);
        $stmt2->execute();
        $stmt2->close();

        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
        die("Hiba történt: " . $e->getMessage());
    }

    echo "<div style='display: flex; justify-content: center; align-items: center; height: 100vh;'>
            <div style='background-color: #17a2b8; color: white; padding: 20px; border-radius: 10px; font-size: 20px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);'>
                Bérlés költsége: " . number_format($total_price, 0, '.', ' ') . " Ft
                <h2>Sikeres bérlés!</h2>
                <p>5 másodperc múlva átirányítunk...</p>
            </div>
          </div>";
    echo '<script>
        setTimeout(function() {
            window.location.href = "velemeny.php";
        }, 5000);
    </script>';

    exit();
}

$conn->close();

// Ha nincs POST kérés, akkor űrlap megjelenítése
$auto_id = isset($_GET['auto_id']) ? htmlspecialchars($_GET['auto_id']) : '';
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bérlés</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #6a82fb, #fc5c7d);
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: 'Arial', sans-serif;
            color: white;
        }
        .container {
            background: rgba(0, 0, 0, 0.7);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.3);
            max-width: 600px;
            margin-top: 50px;
        }
        h2 {
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Bérlés</h2>
        <form action="berles.php" method="POST">
            <div class="form-group">
                <label for="auto_id">Autó ID:</label>
                <input type="text" class="form-control" id="auto_id" name="auto_id" value="<?php echo $auto_id; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="nev">Név:</label>
                <input type="text" class="form-control" id="nev" name="nev" value="<?= $user['nev'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" readonly>
            </div>
            <div class="form-group">
                <label for="berles_kezdet">Bérlés kezdete:</label>
                <input type="date" class="form-control" id="berles_kezdet" name="berles_kezdet" required>
            </div>
            <div class="form-group">
                <label for="berles_vege">Bérlés vége:</label>
                <input type="date" class="form-control" id="berles_vege" name="berles_vege" required>
            </div>
<!-- asdddsadasdsdfsdgfa asd  asd a dsa dfgfdasdfas gfdagdfgdfg saderwz rtjghjcfhrsbfbdsbdgfshfdhbsdhb     -->
            <button type="submit" class="btn btn-primary">Bérlés véglegesítése</button>
        </form>
    </div>

    <script>
        // Az autó árát PHP-ból jövő változóként inicializáljuk
        const carPrice = <?php echo $auto_ar; ?>;

        // Eseményfigyelők a dátumváltozásokra
        const startDateInput = document.getElementById("berles_kezdet");
        const endDateInput = document.getElementById("berles_vege");

        startDateInput.addEventListener("change", calculateTotalPrice);
        endDateInput.addEventListener("change", calculateTotalPrice);

        function calculateTotalPrice() {
            const startDate = startDateInput.value;
            const endDate = endDateInput.value;

            // Ellenőrizzük, hogy mindkét dátum meg van adva
            if (startDate && endDate) {
                const start = new Date(startDate);
                const end = new Date(endDate);

                // Ha a vég dátuma kisebb vagy egyenlő, mint a kezdő dátum
                if (end <= start) {
                    alert("A bérlés vége nem lehet korábban, mint a kezdete!");
                    document.getElementById("total_price").value = ''; // Ha érvénytelen, töröljük az árat
                    return; // Kilépünk, ha érvénytelen a dátum
                }

                const timeDifference = end - start; // Különbség milliszekundumban
                const days = timeDifference / (1000 * 3600 * 24); // Kiszámítjuk a napok számát
                const totalPrice = days * carPrice; // Kiszámítjuk a teljes árat

                // A teljes ár megjelenítése
                document.getElementById("total_price").value = totalPrice.toFixed(0); // Ft-ban
            } else {
                document.getElementById("total_price").value = ''; // Ha nincs mindkét dátum, töröljük az árat
            }
        }
    </script>

</body>
</html>