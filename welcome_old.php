<?php
session_start();
include 'config.php';

// A hibák megjelenítésének engedélyezése
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Ellenőrizzük, hogy a felhasználó be van-e jelentkezve
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION["username"];
// Már az admin mezőt is lekérdezzük
$stmt = $conn->prepare("SELECT nev, jogositvany_megszerzese, admin FROM users WHERE username = ?");
if ($stmt === false) {
    die('MySQL prepare statement failed: ' . $conn->error);
}
$stmt->bind_param("s", $username);
$stmt->execute();
$stmt->bind_result($nev, $jogositvany_megszerzese, $admin);

if (!$stmt->fetch()) {
    die('Nincs találat a felhasználóra!');
}
$stmt->close();

// Ellenőrizzük, hogy eltelt-e legalább 2 év a jogosítvány megszerzése óta
$jogositvany_datum = new DateTime($jogositvany_megszerzese);
$ma = new DateTime();
$kulonbseg = $jogositvany_datum->diff($ma);
$ev_kulonbseg = $kulonbseg->y;
$kezdoknek = $ev_kulonbseg < 2;
$haladoknak = $ev_kulonbseg < 5;
// Admin ellenőrzés
$isAdmin = ($admin == 1);
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <link rel="icon" type="image/x-icon" href="auto.webp">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üdvözlünk a BBT Autóbérlésnél</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            background: linear-gradient(135deg, #6a82fb, #fc5c7d);
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: 'Arial', sans-serif;
            color: white;
            overflow-x: hidden;
        }

        .colorblack {
            color: black;
        }

        .hero {
            height: 350px;
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            background: rgba(23, 23, 23, 0.26);
            width: 75%;
        }

        .hero h1 {
            font-size: 36px;
            margin-bottom: 10px;
        }

        .hero-h2 {
            height: 80px;
            text-align: center;

            padding: 20px;
            border-radius: 15px;
            background: rgba(23, 23, 23, 0.26);
            width: 40%;
        }

        .hero p {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .hero .btn-danger {
            font-size: 16px;
            padding: 12px 30px;
            border-radius: 25px;
            background-color: #ff758c;
            border: none;
            transition: background-color 0.3s ease-in-out;
        }

        .hero .btn-danger:hover {
            background-color: #ff5a7f;
        }

        .category-card {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            padding: 20px;
            margin-bottom: 30px;
            transition: transform 0.3s ease-in-out;
        }

        .category-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }

        .navbar {
            background: rgba(0, 0, 0, 0.6) !important;
            box-shadow: none !important;
            border-radius: 30px;
            width: 40%;
            height: 10%;
        }

        .navbar-nav .nav-link {
            transition: none !important;
        }

        .navbarcolor {
            font-size: 20px !important;
            color: white !important;

        }

        .katcolor {
            color: white !important;
        }

        /* Új: admin gomb stílus */
        .btn-admin {
            font-size: 16px;
            padding: 12px 30px;
            border-radius: 25px;
            background-color: #4CAF50;
            border: none;
            transition: background-color 0.3s ease-in-out;
            color: white;
            text-decoration: none;
            display: inline-block;
            margin-left: 10px;
        }

        .btn-admin:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <header class="hero">
        <div>
            <h1>Üdvözöljük, <?php echo htmlspecialchars($nev); ?>!</h1><br>
            <p>Válaszd ki a tökéletes autót és indulj útnak!</p>
            <a href="logout.php" class="btn btn-danger btn-lg"><i class="fas fa-sign-out-alt"></i> Kijelentkezés</a>

            <?php if ($isAdmin): ?>
                <!-- Admin gomb csak akkor látszik, ha admin vagy -->
                <a href="add_car.php" class="btn-admin"><i class="fas fa-plus"></i> Admin - Autó hozzáadása</a>
            <?php endif; ?>
        </div>
    </header>
    <br>
    <br>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">BBT Autóbérlő</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link navbarcolor" href="#">Főoldal <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link navbarcolor" href="kapcsolat.php">Kapcsolat</a>
            </li>
            <li class="nav-item">
                <span class="navbar-text" id="current-time"></span>
            </li>
        </ul>
    </div>
</nav>

<script>
    function fetchTime() {
        fetch('http://worldtimeapi.org/api/timezone/Europe/Budapest') // API endpoint
            .then(response => response.json())
            .then(data => {
                const timeElement = document.getElementById('current-time');
                const currentTime = new Date(data.datetime);
                const hours = currentTime.getHours().toString().padStart(2, '0');
                const minutes = currentTime.getMinutes().toString().padStart(2, '0');
                const seconds = currentTime.getSeconds().toString().padStart(2, '0');
                timeElement.textContent = `${hours}:${minutes}:${seconds}`;
            })
            .catch(error => console.error('Error fetching time:', error));
    }

    fetchTime(); // Initial call to fetch and display the time immediately
    setInterval(fetchTime, 60000); // Update time every minute

    // This function updates the seconds locally every second
    function updateSeconds() {
        const timeElement = document.getElementById('current-time');
        const currentTime = new Date();
        const hours = currentTime.getHours().toString().padStart(2, '0');
        const minutes = currentTime.getMinutes().toString().padStart(2, '0');
        const seconds = currentTime.getSeconds().toString().padStart(2, '0');
        timeElement.textContent = `${hours}:${minutes}:${seconds}`;
    }

    setInterval(updateSeconds, 1000); // Update seconds every second
</script>



    <section id="autok" class="container py-5">
        <h2 class="text-center section-title mb-5 katcolor">Válassz kategóriát</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card category-card text-center">
                    <div class="card-body">
                        <h3 class="card-title"><i class="fas fa-road"></i> Kezdőknek</h3>
                        <p>0-2 éves jogosítvánnyal vezethető autók.</p>
                        <a href="kezdoautok.php" class="btn btn-dark">Megnézem</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card category-card text-center">
                    <div class="card-body">
                        <h3 class="card-title"><i class="fas fa-car"></i> Haladóknak</h3>
                        <p>2-5 éves jogosítvánnyal vezethető autók.</p>
                        <a href="haladoautok.php" class="btn btn-dark <?php echo $kezdoknek ? 'disabled' : ''; ?>">Megnézem</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card category-card text-center">
                    <div class="card-body">
                        <h3 class="card-title"><i class="fas fa-crown"></i> Profiknak</h3>
                        <p>5+ éves jogosítvánnyal vezethető autók.</p>
                        <a href="profiautok.php" class="btn btn-dark <?php echo $haladoknak ? 'disabled' : ''; ?>">Megnézem</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>




<?php
// Vélemények lekérdezése
$stmt = $conn->prepare("SELECT username, velemeny, pro, contra, ertekeles, datum FROM velemenyek ORDER BY datum DESC LIMIT 3");
$stmt->execute();
$result = $stmt->get_result();
?>

<?php
// Oldalanként 3 vélemény megjelenítése
$velemenyek_per_page = 3;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $velemenyek_per_page;

// Vélemények lekérdezése a megfelelő oldalszámmal
$stmt = $conn->prepare("SELECT username, velemeny, pro, contra, ertekeles, datum FROM velemenyek ORDER BY datum DESC LIMIT ?, ?");
$stmt->bind_param("ii", $offset, $velemenyek_per_page);
$stmt->execute();
$result = $stmt->get_result();

// Összes vélemény számolása
$total_stmt = $conn->prepare("SELECT COUNT(*) AS total FROM velemenyek");
$total_stmt->execute();
$total_result = $total_stmt->get_result();
$total_row = $total_result->fetch_assoc();
$total_velemenyek = $total_row['total'];
$total_pages = ceil($total_velemenyek / $velemenyek_per_page);
?>

<section class="container mt-5">
    <h2 class="text-center text-white">Felhasználói vélemények</h2>
    <br>
    <br>
    <div class="row">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col-md-4">
                <div class="card category-card text-center">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-user"></i> <?php echo htmlspecialchars($row['username']); ?></h5>
                        <p><?php echo nl2br(htmlspecialchars($row['velemeny'])); ?></p>
                        <p><strong>Pro:</strong> <?php echo htmlspecialchars($row['pro']); ?></p>
                        <p><strong>Contra:</strong> <?php echo htmlspecialchars($row['contra']); ?></p>
                        <p>
                            <?php for ($i = 0; $i < $row['ertekeles']; $i++): ?>
                                <i class="fas fa-star text-warning"></i>
                            <?php endfor; ?>
                            <?php for ($i = $row['ertekeles']; $i < 5; $i++): ?>
                                <i class="far fa-star text-warning"></i>
                            <?php endfor; ?>
                        </p>
                        <small class="text-muted"><?php echo date("Y-m-d", strtotime($row['datum'])); ?></small>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>

    <br>
    <br>
    <br>
    <!-- Lapozó navigáció -->
    <nav aria-label="Page navigation">
        <ul class="pagination justify-content-center">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page - 1; ?>">Előző</a>
                </li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?php echo ($i == $page) ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>
            <?php if ($page < $total_pages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $page + 1; ?>">Következő</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</section>

<?php
// Vélemények lekérdezése
// $stmt = $conn->prepare("select count(auto_id), auto_id FROM `berlesek` GROUP BY auto_id HAVING COUNT(auto_id) > 0;");
// // select count(auto_id), auto_id FROM `berlesek` GROUP BY auto_id HAVING COUNT(auto_id) > 0 ORDER BY count(auto_id) DESC;
// $stmt->execute();
// $result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popup Ajánlat</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .popup-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
        }

        .popup {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 400px;
            animation: fadeIn 0.3s;
        }

        .popup button {
            margin-top: 10px;
            padding: 10px;
            background: red;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>

<body>

</body>

</html>
<?php
// Lekérdezzük a legnépszerűbb autókat
$stmt = $conn->prepare("
    SELECT COUNT(b.auto_id) AS berles_szam, c.marka, c.tipus
    FROM berlesek b
    JOIN cars c ON b.auto_id = c.id
    GROUP BY b.auto_id, c.marka, c.tipus
    HAVING COUNT(b.auto_id) > 0
    ORDER BY berles_szam DESC
    LIMIT 5
");
$stmt->execute();
$result = $stmt->get_result();


$auto_idk = [];
$berles_szamok = [];

while ($row = $result->fetch_assoc()) {
    $auto_idk[] = $row['marka'] . ' ' . $row['tipus'];
    $berles_szamok[] = $row['berles_szam'];
}
?>

<section class="container mt-5">
    <center>
        <h2 class="text-center text-white hero-h2">Legkelendőbb autók</h2>
    </center>
    <canvas id="popularCarsChart"></canvas>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script class="colorblack">
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('popularCarsChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($auto_idk); ?>,
                datasets: [{
                    label: 'Bérlések száma',
                    data: <?php echo json_encode($berles_szamok); ?>,
                    backgroundColor: 'yellow',
                    borderColor: 'rgb(0, 255, 4)',
                    borderWidth: 5
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        labels: {
                            color: 'white',
                            font: {
                                weight: 'bold',
                                size: 16
                            }
                        }
                    },
                    datalabels: {
                        anchor: 'end',
                        align: 'top',
                        color: 'white',
                        font: {
                            weight: 'bold',
                            size: 14
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: 'white',
                            font: {
                                weight: 'bold',
                                size: 16
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white',
                            font: {
                                weight: 'bold',
                                size: 14
                            }
                        }
                    }
                }
            },
            plugins: [ChartDataLabels]
        });
    });
</script>


</html>