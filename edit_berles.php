<?php
include('config.php');
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
if (!isset($_SESSION['user_id']) || $_SESSION['admin'] != 1) {
    header('Location: login.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: add_car.php');
    exit();
}


$id = intval($_GET['id']);

// Lekérjük az aktuális bérlést
$berles_result = mysqli_query($conn, "SELECT * FROM berlesek WHERE id = $id");
if (mysqli_num_rows($berles_result) == 0) {
    echo "Nincs ilyen bérlés!";
    exit();
}
$berles = mysqli_fetch_assoc($berles_result);

// Lekérjük az autókat a legördülő listához
$cars_result = mysqli_query($conn, "SELECT id, marka, tipus FROM cars");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $auto_id = intval($_POST['auto_id']);
    $ugyfel_nev = mysqli_real_escape_string($conn, $_POST['ugyfel_nev']);
    $berles_kezdete = mysqli_real_escape_string($conn, $_POST['berles_kezdete']);
    $berles_vege = mysqli_real_escape_string($conn, $_POST['berles_vege']);

    $update_sql = "
        UPDATE berlesek SET
            auto_id = $auto_id,
            ugyfel_nev = '$ugyfel_nev',
            berles_kezdete = '$berles_kezdete',
            berles_vege = '$berles_vege'
        WHERE id = $id
    ";

    if (mysqli_query($conn, $update_sql)) {
        header("Location: add_car.php");
        exit();
    } else {
        echo "Hiba: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Bérlés szerkesztése</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f0f0f0; padding: 30px; }
        h2 { text-align: center; }
        form {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        label { margin-top: 10px; display: block; }
        input, select, button {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
        }
        button:hover { background-color: #218838; }
        a { display: block; text-align: center; margin-top: 20px; color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<h2>Bérlés szerkesztése (ID: <?php echo $berles['id']; ?>)</h2>

<form method="POST">
    <label for="auto_id">Autó:</label>
    <select name="auto_id" id="auto_id" required>
        <?php while ($car = mysqli_fetch_assoc($cars_result)) : ?>
            <option value="<?php echo $car['id']; ?>"
                <?php if ($car['id'] == $berles['auto_id']) echo 'selected'; ?>>
                <?php echo htmlspecialchars($car['marka'] . ' ' . $car['tipus']); ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label for="ugyfel_nev">Ügyfél neve:</label>
    <input type="text" name="ugyfel_nev" id="ugyfel_nev" value="<?php echo htmlspecialchars($berles['ugyfel_nev']); ?>" required>

    <label for="berles_kezdete">Bérlés kezdete:</label>
    <input type="datetime-local" name="berles_kezdete" id="berles_kezdete" value="<?php echo date('Y-m-d\TH:i', strtotime($berles['berles_kezdete'])); ?>" required>

    <label for="berles_vege">Bérlés vége:</label>
    <input type="date" name="berles_vege" id="berles_vege" value="<?php echo htmlspecialchars($berles['berles_vege']); ?>" required>

    <button type="submit">Mentés</button>
</form>

<a href="add_car.php">Vissza az Admin felületre</a>

</body>
</html>
