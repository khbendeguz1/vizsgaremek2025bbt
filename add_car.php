<?php
session_start();
require 'db_connect.php';

// Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

// Lekérjük a felhasználó adatait
$username = $_SESSION["username"];
$stmt = $conn->prepare("SELECT admin FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($isAdmin);
$stmt->fetch();
$stmt->close();

// Ha nem admin, irányítsuk vissza a welcome oldalra
if ($isAdmin != 1) {
    header("Location: welcome.php");
    exit();
}

// Ha admin és POST kérelem jött jármű hozzáadására
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_car'])) {
    $marka = $_POST['marka'];
    $tipus = $_POST['tipus'];
    $leiras = $_POST['leiras'];
    $kep = $_POST['kep'];
    $kategoria = $_POST['kategoria'];
    $berelve = $_POST['berelve'];

    $sql = "INSERT INTO cars (marka, tipus, leiras, kep, kategoria, berelve)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssii", $marka, $tipus, $leiras, $kep, $kategoria, $berelve);

    if ($stmt->execute()) {
        $msg = "Új autó sikeresen hozzáadva!";
    } else {
        $msg = "Hiba: " . $stmt->error;
    }
    $stmt->close();
}

// Lekérjük az adatokat
$cars_result = $conn->query("SELECT * FROM cars");
$users_result = $conn->query("SELECT * FROM users");
$rents_result = $conn->query("SELECT * FROM berlesek"); // Új: Bérlések tábla lekérés
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - BBT Autóbérlés</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #6a82fb, #fc5c7d) fixed;
            color: white;
        }

        .nav-link {
            color: white !important;
            position: relative;
            transition: color 0.3s;
        }

        /* Aktív tab animáció */
        .nav-link.active {
            color: #FFD700 !important;
        }

        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            width: 0;
            height: 3px;
            background-color: #FFD700;
            transition: width 0.4s ease, left 0.4s ease;
        }

        .nav-link.active:hover::after {
            width: 100%;
            left: 0;
        }

        /* Első betöltésnél az aktív legyen animált */
        .nav-tabs .nav-item.show .nav-link,
        .nav-tabs .nav-link.active {
            background-color: transparent;
            border-color: transparent;
        }

        .admin-container {
            margin: 20px;
        }

        .btn-modal {
            margin: 5px;
        }

        .modal-content {
            color: black;
        }

        .table th,
        .table td {
            color: white;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Admin Panel</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="welcome.php">Vissza a Főoldalra</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Kijelentkezés</a></li>
            </ul>
        </div>
    </nav>

    <div class="admin-container container">
        <?php if (isset($msg)) echo "<div class='alert alert-info'>$msg</div>"; ?>

        <!-- Tab menü -->
        <ul class="nav nav-tabs" id="adminTabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="cars-tab" data-toggle="tab" href="#cars" role="tab">Járművek</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="users-tab" data-toggle="tab" href="#users" role="tab">Felhasználók</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="rents-tab" data-toggle="tab" href="#rents" role="tab">Bérlések</a>
            </li>
        </ul>

        <div class="tab-content mt-4" id="adminTabsContent">

            <!-- Járművek -->
            <div class="tab-pane fade show active" id="cars" role="tabpanel">
                <h3>Járművek kezelése</h3>
                <button class="btn btn-success mb-3" data-toggle="modal" data-target="#addCarModal">Új autó hozzáadása</button>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Márka</th>
                            <th>Típus</th>
                            <th>Kategória</th>
                            <th>Akciók</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($car = $cars_result->fetch_assoc()) : ?>
                            <tr>
                                <td><?= $car['id'] ?></td>
                                <td><?= htmlspecialchars($car['marka']) ?></td>
                                <td><?= htmlspecialchars($car['tipus']) ?></td>
                                <td><?= htmlspecialchars($car['kategoria']) ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm btn-modal" data-toggle="modal" data-target="#editCarModal<?= $car['id'] ?>">Szerkesztés</button>
                                    <a href="delete_car.php?id=<?= $car['id'] ?>" class="btn btn-danger btn-sm">Törlés</a>
                                </td>
                            </tr>

                            <!-- Szerkesztés modal jármű -->
                            <div class="modal fade" id="editCarModal<?= $car['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <form method="post" action="edit_car.php">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Jármű szerkesztése</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="<?= $car['id'] ?>">
                                                <p>Márka</p><input type="text" name="marka" class="form-control mb-2" value="<?= htmlspecialchars($car['marka']) ?>" required>
                                                <p>Típus</p><input type="text" name="tipus" class="form-control mb-2" value="<?= htmlspecialchars($car['tipus']) ?>" required>
                                                <p>Leírás</p><input type="text" name="leiras" class="form-control mb-2" value="<?= htmlspecialchars($car['leiras']) ?>" required>
                                                <p>Kép</p><input type="text" name="kep" class="form-control mb-2" value="<?= htmlspecialchars($car['kep']) ?>" required>
                                                <p>Kategória</p><input type="number" name="kategoria" class="form-control mb-2" value="<?= $car['kategoria'] ?>" required>
                                                <p>Bérelve</p><input type="number" name="berelve" class="form-control mb-2" value="<?= $car['berelve'] ?>" required>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Mentés</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <!-- Felhasználók -->
            <div class="tab-pane fade" id="users" role="tabpanel">
                <h3>Felhasználók kezelése</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Felhasználónév</th>
                            <th>Név</th>
                            <th>Jogosítvány</th>
                            <th>Admin</th>
                            <th>Akciók</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($user = $users_result->fetch_assoc()) : ?>
                            <tr>
                                <td><?= $user['id'] ?></td>
                                <td><?= htmlspecialchars($user['username']) ?></td>
                                <td><?= htmlspecialchars($user['nev']) ?></td>
                                <td><?= htmlspecialchars($user['jogositvany_megszerzese']) ?></td>
                                <td><?= $user['admin'] == 1 ? 'Igen' : 'Nem' ?></td>
                                <td>
                                    <button class="btn btn-warning btn-sm btn-modal" data-toggle="modal" data-target="#editUserModal<?= $user['id'] ?>">Szerkesztés</button>
                                    <a href="delete_user.php?id=<?= $user['id'] ?>" class="btn btn-danger btn-sm">Törlés</a>
                                </td>
                            </tr>

                            <!-- Szerkesztés modal user -->
                            <div class="modal fade" id="editUserModal<?= $user['id'] ?>" tabindex="-1">
                                <div class="modal-dialog">
                                    <form method="post" action="edit_user.php">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Felhasználó szerkesztése</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                                <input type="text" name="username" class="form-control mb-2" value="<?= htmlspecialchars($user['username']) ?>" required>
                                                <input type="text" name="nev" class="form-control mb-2" value="<?= htmlspecialchars($user['nev']) ?>" required>
                                                <input type="date" name="jogositvany_megszerzese" class="form-control mb-2" value="<?= htmlspecialchars($user['jogositvany_megszerzese']) ?>" required>
                                                <select name="admin" class="form-control mb-2">
                                                    <option value="1" <?= $user['admin'] == 1 ? 'selected' : '' ?>>Igen</option>
                                                    <option value="0" <?= $user['admin'] == 0 ? 'selected' : '' ?>>Nem</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Mentés</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <!-- Bérlések -->
            <div class="tab-pane fade" id="rents" role="tabpanel">
                <h3>Bérlések kezelése</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Felhasználó ID</th>
                            <th>Autó ID</th>
                            <th>Bérlés kezdete</th>
                            <th>Bérlés vége</th>
                            <th>Bérlő neve</th>
                            <th>Akciók</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($rent = $rents_result->fetch_assoc()) : ?>
                            <tr>

                                <td><?= htmlspecialchars($rent['id']) ?></td>
                                <td><?= htmlspecialchars($rent['auto_id']) ?></td>
                                <td><?= htmlspecialchars($rent['berles_kezdete']) ?></td>
                                <td><?= htmlspecialchars($rent['berles_vege']) ?></td>
                                <td><?= htmlspecialchars($rent['ugyfel_nev']) ?></td>
                                <td>
                                    <a href="edit_berles.php?id=<?= $rent['id'] ?>" class="btn btn-warning btn-sm">Szerkesztés</a>
                                    <a href="delete_berles.php?id=<?= $rent['id'] ?>" class="btn btn-danger btn-sm">Törlés</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- Modal az autók hozzáadásához -->
    <div class="modal fade" id="addCarModal" tabindex="-1">
        <div class="modal-dialog">
            <form method="post" action="<?= htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Új autó hozzáadása</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="add_car" value="1">
                        <input type="text" name="marka" class="form-control mb-2" placeholder="Márka" required>
                        <input type="text" name="tipus" class="form-control mb-2" placeholder="Típus" required>
                        <textarea name="leiras" class="form-control mb-2" placeholder="Leírás" required></textarea>
                        <input type="text" name="kep" class="form-control mb-2" placeholder="Kép URL" required>
                        <input type="number" name="kategoria" class="form-control mb-2" placeholder="Kategória" required>
                        <input type="number" name="berelve" class="form-control mb-2" placeholder="Bérelve (0 vagy 1)" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Hozzáadás</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>

<?php
$conn->close();
?>