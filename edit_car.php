<?php
include('db_connect.php');

// SESSION CHECK
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['admin'] != 1) {
    header('Location: login.php');
    exit();
}

// LEKÉRDEZÉSEK
$users_result = mysqli_query($conn, "SELECT * FROM users");
$cars_result = mysqli_query($conn, "SELECT * FROM cars");
$berlesek_result = mysqli_query($conn, "SELECT * FROM berlesek");

// TÖRLÉSEK
if (isset($_GET['delete_car'])) {
    $id = intval($_GET['delete_car']);
    mysqli_query($conn, "DELETE FROM cars WHERE id = $id");
    header("Location: add_car.php");
    exit();
}

if (isset($_GET['delete_user'])) {
    $id = intval($_GET['delete_user']);
    mysqli_query($conn, "DELETE FROM users WHERE id = $id");
    header("Location: add_car.php");
    exit();
}

if (isset($_GET['delete_berles'])) {
    $id = intval($_GET['delete_berles']);
    mysqli_query($conn, "DELETE FROM berlesek WHERE id = $id");
    header("Location: add_car.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <title>Admin Felület</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 40px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
        a.button {
            padding: 8px 12px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
        a.button:hover {
            background-color: #0056b3;
        }
        h2 {
            margin-top: 60px;
        }
    </style>
</head>
<body>
    <h1>Admin Felület</h1>

    <!-- Felhasználók szekció -->
    <h2>Felhasználók</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Név</th>
                <th>Email</th>
                <th>Admin</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($user = mysqli_fetch_assoc($users_result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['id']); ?></td>
                    <td><?php echo htmlspecialchars($user['name']); ?></td>
                    <td><?php echo htmlspecialchars($user['email']); ?></td>
                    <td><?php echo $user['admin'] == 1 ? 'Igen' : 'Nem'; ?></td>
                    <td>
                        <a href="edit_user.php?id=<?php echo $user['id']; ?>" class="button">Szerkesztés</a>
                        <a href="?delete_user=<?php echo $user['id']; ?>" class="button" onclick="return confirm('Biztosan törölni szeretnéd?')">Törlés</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Autók szekció -->
    <h2>Autók</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Márka</th>
                <th>Modell</th>
                <th>Évjárat</th>
                <th>Ár (naponta)</th>
                <th>Státusz</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($car = mysqli_fetch_assoc($cars_result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($car['id']); ?></td>
                    <td><?php echo htmlspecialchars($car['brand']); ?></td>
                    <td><?php echo htmlspecialchars($car['model']); ?></td>
                    <td><?php echo htmlspecialchars($car['year']); ?></td>
                    <td><?php echo htmlspecialchars($car['price']); ?> Ft</td>
                    <td><?php echo htmlspecialchars($car['status']); ?></td>
                    <td>
                        <a href="edit_car.php?id=<?php echo $car['id']; ?>" class="button">Szerkesztés</a>
                        <a href="?delete_car=<?php echo $car['id']; ?>" class="button" onclick="return confirm('Biztosan törölni szeretnéd az autót?')">Törlés</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <!-- Bérlések szekció -->
    <h2>Bérlések</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Autó ID</th>
                <th>Ügyfél neve</th>
                <th>Bérlés kezdete</th>
                <th>Bérlés vége</th>
                <th>Műveletek</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($berles = mysqli_fetch_assoc($berlesek_result)) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($berles['id']); ?></td>
                    <td><?php echo htmlspecialchars($berles['auto_id']); ?></td>
                    <td><?php echo htmlspecialchars($berles['ugyfel_nev']); ?></td>
                    <td><?php echo htmlspecialchars($berles['berles_kezdete']); ?></td>
                    <td><?php echo htmlspecialchars($berles['berles_vege']); ?></td>
                    <td>
                        <a href="edit_berles.php?id=<?php echo $berles['id']; ?>" class="button">Szerkesztés</a>
                        <a href="?delete_berles=<?php echo $berles['id']; ?>" class="button" onclick="return confirm('Biztosan törölni szeretnéd a bérlést?')">Törlés</a>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>
