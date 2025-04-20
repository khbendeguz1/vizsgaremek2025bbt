berles_vege<?php
include('config.php');
$_SESSION['user_id'] = $user['id'];
$_SESSION['admin'] = $user['admin']; // ez fontos!
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['admin'] != 1) {
    header('Location: login.php');
    exit();
}

// Lekérjük az autókat
$cars_result = mysqli_query($conn, "SELECT id, marka, tipus FROM cars");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $auto_id = intval($_POST['auto_id']);
    $ugyfel_nev = mysqli_real_escape_string($conn, $_POST['ugyfel_nev']);
    $berles_kezdete = mysqli_real_escape_string($conn, $_POST['berles_kezdete']);
    $berles_vege = mysqli_real_escape_string($conn, $_POST['berles_vege']);

    $insert_sql = "
        INSERT INTO berlesek (auto_id, ugyfel_nev, berles_kezdete, berles_vege)
        VALUES ($auto_id, '$ugyfel_nev', '$berles_kezdete', '$berles_vege')
    ";

    if (mysqli_query($conn, $insert_sql)) {
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
    <title>Új bérlés hozzáadása</title>
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
            background-color: #007bff;
            color: white;
            border: none;
        }
        button:hover { background-color: #0056b3; }
        a { display: block; text-align: center; margin-top: 20px; color: #007bff; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<h2>Új bérlés hozzáadása</h2>

<form method="POST">
    <label for="auto_id">Autó:</label>
    <select name="auto_id" id="auto_id" required>
        <?php while ($car = mysqli_fetch_assoc($cars_result)) : ?>
            <option value="<?php echo $car['id']; ?>">
                <?php echo htmlspecialchars($car['marka'] . ' ' . $car['tipus']); ?>
            </option>
        <?php endwhile; ?>
    </select>

    <label for="ugyfel_nev">Ügyfél neve:</label>
    <input type="text" name="ugyfel_nev" id="ugyfel_nev" required>

    <label for="berles_kezdete">Bérlés kezdete:</label>
    <input type="datetime-local" name="berles_kezdete" id="berles_kezdete" required>

    <label for="berles_vege">Bérlés vége:</label>
    <input type="date" name="berles_vege" id="berles_vege" required>

    <button type="submit">Hozzáadás</button>
</form>

<a href="add_car.php">Vissza az Admin felületre</a>

</body>
</html>
