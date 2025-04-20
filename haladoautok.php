<?php
$servername = "localhost";
$username = "autoberlo";
$password = "Szily2025";
$dbname = "autoberlo";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';
$sort_order = isset($_GET['sort']) && $_GET['sort'] == 'desc' ? 'DESC' : 'ASC';

$sql = "SELECT * FROM cars WHERE kategoria = '2' AND berelve = '0'";
if ($search) {
    $sql .= " AND marka LIKE '%$search%' and kategoria = '2'";
}
$sql .= " ORDER BY ar $sort_order";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haladó autók</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="style.css">
    <script>
        $(document).ready(function() {
            $('#sortOrder').on('change', function() {
        var sortValue = $(this).val();  
        var searchValue = $('#search').val();   
        window.location.href = "?search=" + encodeURIComponent(searchValue) + "&sort=" + sortValue;
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#search').on('input', function() {
                var searchValue = $(this).val();
                $.get("", {
                    search: searchValue
                }, function(data) {
                    var newBody = $(data).find("tbody").html();
                    $("tbody").html(newBody);
                });
            });
        });
    </script>

    <style>
        .autoinfo {
            color: black;
        }

        body {
            background: linear-gradient(135deg, #6a82fb, #fc5c7d) fixed;
            font-family: 'Arial', sans-serif;
            color: white;

        }

        .navbarcolor {
            font-size: 20px !important;
            color: white !important;

        }

        .navbar {
            box-shadow: 10px 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            background: rgba(23, 23, 23, 0.26) !important;
            width: 95%;

        }

        .container {
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .table {
            background: rgba(255, 255, 255, 0.9);
            color: black;
            border-radius: 10px;
            overflow: hidden;
        }

        .table th,
        .table td {
            text-align: center;
            vertical-align: middle;
            padding: 15px;
        }

        .table img {
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background: #ff416c;
            border: none;
            transition: 0.3s;
            padding: 10px 20px;
            /* Egységesített padding */
            font-size: 16px;
            /* Egységes betűméret */
            text-align: center;
        }

        .btn-primary:hover {
            background: #ff4b2b;
            transform: scale(1.05);
        }

        .modal-content {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
        }

        .modal-body img {
            border-radius: 10px;
            width: 100%;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
        }

        #search {
            border-radius: 25px;
            padding: 10px;
            border: none;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            transition: 0.3s;
        }

        #search:focus {
            outline: none;
            transform: scale(1.05);
        }
    </style>
</head>

<body>
    <center>
        <nav class="navbar navbar-expand-lg navbarcolor">
            <a class="navbar-brand navbarcolor" href="#">BBT Autóbérlő</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link navbarcolor" href="welcome.php">Főoldal <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link navbarcolor" href="kapcsolat.php">Kapcsolat</a>
                    </li>
                </ul>
            </div>
        </nav>
    </center>
    <div class="container mt-4">
        <h2 class="mb-3">Haladó autók listája</h2>
        <input type="text" id="search" class="form-control mb-3" placeholder="Keresés márka alapján...">
        <select id="sortOrder" class="form-control mb-3">
            <option value="asc" <?= $sort_order == 'ASC' ? 'selected' : '' ?>>Ár szerint növekvő</option>
            <option value="desc" <?= $sort_order == 'DESC' ? 'selected' : '' ?>>Ár szerint csökkenő</option>
        </select>
        <table class="table table-bordered">
        <thead>
    <tr>
        <th>Márka</th>
        <th>Típus</th>
        <th>Kép</th>
        <th>Ár</th> 
        <th>Művelet</th>
    </tr>
</thead>
<tbody>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['marka'] ?></td>
            <td><?= $row['tipus'] ?></td>
            <td><img src="<?= $row['kep'] ?>" alt="Car Image" style="width:100px;"></td>
            <td><?= number_format($row['ar'], 0, '.', ' ') ?> Ft/nap</td> 
            <td><button class="btn btn-primary" data-toggle="modal" data-target="#modal<?= $row['id'] ?>">Megtekintés</button></td>
        </tr>
    <?php } ?>
</tbody>
        </table>
    </div>

    <?php $result->data_seek(0);
    while ($row = $result->fetch_assoc()) { ?>
        <div class="modal fade" id="modal<?= $row['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="modalLabel<?= $row['id'] ?>" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="autoinfo" id="modalLabel<?= $row['id'] ?>"><?= $row['marka'] . " " . $row['tipus'] ?></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img src="<?= $row['kep'] ?>" alt="Car Image" class="img-fluid mb-3">
                        <p class="autoinfo"><?= $row['leiras'] ?></p>
                        <p class="autoinfo"><strong>Ár: </strong><?= number_format($row['ar'], 0, '.', ' ') ?> Ft/nap</p> 
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Bezárás</button>
                        <a href="berles.php?auto_id=<?= $row['id'] ?>&jogositvany_szam=<?= $row['jogositvany_szam'] ?>&berles_kezdet=<?= date('Y-m-d') ?>&nev=<?= urlencode('Felhasználó neve') ?>&email=<?= urlencode('felhasznalo@email.hu') ?>" class="btn btn-primary">Bérlés</a>
                    </div>

                </div>
            </div>
        </div>
    <?php } ?>

    <?php $conn->close(); ?>
</body>

</html>