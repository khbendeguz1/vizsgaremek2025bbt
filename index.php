<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBT Autóbérlő</title>
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
            /* Átlátszó háttér */
            border: none;
            /* Eltünteti a határokat */
        }

        .navbar-brand,
        .nav-link {
            color: white !important;
            /* Fehér színű szöveg */
        }

        .navbar-toggler-icon {
            background-color: white;
            /* Fehér menü ikon */
        }

        .navbar-nav .nav-item.active .nav-link {
            color: #ff758c !important;
            /* Aktív link színe */
        }

        .jumbotron {
            background: rgba(0, 0, 0, 0.4);
            border-radius: 15px;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.3);
            text-align: center;
            padding: 50px 30px;
            margin-top: 50px;
        }

        .jumbotron h1 {
            font-size: 3em;
            margin-bottom: 20px;
        }

        .jumbotron p {
            font-size: 1.2em;
            margin-bottom: 30px;
        }

        .jumbotron img {
            width: 80%;
            max-width: 600px;
            margin-bottom: 30px;
            border-radius: 10px;
        }

        .btn {
            padding: 12px 30px;
            border-radius: 25px;
            font-size: 16px;
            transition: 0.3s;
        }

        .btn-primary {
            background-color: #ff758c;
            border: none;
        }

        .btn-primary:hover {
            background-color: #ff5a7f;
        }

        .btn-secondary {
            background-color: #333;
            border: none;
        }

        .btn-secondary:hover {
            background-color: #444;
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
                <li class="nav-item active">
                    <a class="nav-link" href="#">Főoldal <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="kapcsolat.php">Kapcsolat</a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- HERO SZEKCIÓ -->
    <div class="jumbotron">
        <h1 class="display-4">Üdvözöljük a BBT Autóbérlőnél!</h1>
        <p class="lead">A legjobb autók a legjobb áron.</p>
        <img src="auto.webp" alt="Autó" class="img-fluid">
        <hr class="my-4">
        <a class="btn btn-primary btn-lg" href="login.php" role="button">Belépés</a>
        <a class="btn btn-secondary btn-lg" href="registration.php" role="button">Regisztráció</a>
        <a class="btn btn-secondary btn-lg" href="autok.php" role="button">Autók megtekintése</a>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>