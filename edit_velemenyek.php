<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "autoberlo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kapcsolódási hiba: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $stmt = $conn->prepare("INSERT INTO velemenyek (username, velemeny, pro, contra, ertekeles) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssi", $_POST['username'], $_POST['velemeny'], $_POST['pro'], $_POST['contra'], $_POST['ertekeles']);
        $stmt->execute();
        $stmt->close();
    }
    if (isset($_POST['update'])) {
        $stmt = $conn->prepare("UPDATE velemenyek SET username=?, velemeny=?, pro=?, contra=?, ertekeles=? WHERE id=?");
        $stmt->bind_param("ssssii", $_POST['username'], $_POST['velemeny'], $_POST['pro'], $_POST['contra'], $_POST['ertekeles'], $_POST['id']);
        $stmt->execute();
        $stmt->close();
    }
    if (isset($_POST['delete'])) {
        $stmt = $conn->prepare("DELETE FROM velemenyek WHERE id=?");
        $stmt->bind_param("i", $_POST['id']);
        $stmt->execute();
        $stmt->close();
    }
}

$results = $conn->query("SELECT * FROM velemenyek");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Vélemények Kezelése</title>
</head>
<body>
    <h2>Vélemények</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Felhasználó</th>
            <th>Vélemény</th>
            <th>Pozitív</th>
            <th>Negatív</th>
            <th>Értékelés</th>
            <th>Műveletek</th>
        </tr>
        <?php while ($row = $results->fetch_assoc()): ?>
            <tr>
                <form method="POST">
                    <td><?= $row['id'] ?></td>
                    <td><input type="text" name="username" value="<?= htmlspecialchars($row['username']) ?>" required></td>
                    <td><input type="text" name="velemeny" value="<?= htmlspecialchars($row['velemeny']) ?>" required></td>
                    <td><input type="text" name="pro" value="<?= htmlspecialchars($row['pro']) ?>" required></td>
                    <td><input type="text" name="contra" value="<?= htmlspecialchars($row['contra']) ?>" required></td>
                    <td><input type="number" name="ertekeles" value="<?= $row['ertekeles'] ?>" min="1" max="5" required></td>
                    <td>
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button type="submit" name="update">Módosítás</button>
                        <button type="submit" name="delete" onclick="return confirm('Biztosan törlöd?');">Törlés</button>
                    </td>
                </form>
            </tr>
        <?php endwhile; ?>
    </table>
    
    <h2>Új vélemény hozzáadása</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Felhasználónév" required>
        <input type="text" name="velemeny" placeholder="Vélemény" required>
        <input type="text" name="pro" placeholder="Pozitívumok" required>
        <input type="text" name="contra" placeholder="Negatívumok" required>
        <input type="number" name="ertekeles" placeholder="Értékelés (1-5)" min="1" max="5" required>
        <button type="submit" name="add">Hozzáadás</button>
    </form>
</body>
</html>

<?php $conn->close(); ?>
