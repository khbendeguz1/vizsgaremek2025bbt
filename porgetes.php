<?php
session_start();
include 'config.php';

// Lekérdezés: véletlenszerű autó kiválasztása az adatbázisból
$sql = "SELECT marka, tipus FROM cars ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode(["auto" => $row["marka"] . " " . $row["tipus"]]);
} else {
    echo json_encode(["auto" => "Nincs elérhető autó"]);
}

$conn->close();
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
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        .wheel-container {
            position: relative;
            width: 300px;
            height: 300px;
            margin: 50px auto;
        }
        .wheel {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 5px solid black;
            position: absolute;
            transition: transform 4s ease-out;
        }
        .pointer {
            position: absolute;
            top: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-bottom: 20px solid red;
        }
        #result {
            margin-top: 20px;
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <button onclick="showPopup()">Mutasd az ajánlatot</button>
   
    <div id="popupOverlay" class="popup-overlay" onclick="closePopup(event)">
        <div class="popup" onclick="event.stopPropagation()">
            <h2>Különleges ajánlat!</h2>
            <h2>Szerencsekerék - Véletlenszerű Autóválasztás</h2>
    <div class="wheel-container">
        <div class="pointer"></div>
        <img src="https://i.imgur.com/4PqSx2R.png" class="wheel" id="wheel" alt="Szerencsekerék">
    </div>
    <button onclick="spinWheel()">Pörgetés</button>
    <p id="result"></p>
    
    <script>
        function spinWheel() {
    let rotation = Math.floor(Math.random() * 3600) + 1800;
    document.getElementById("wheel").style.transform = `rotate(${rotation}deg)`;

    setTimeout(() => {
        fetch('porgetes.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById("result").innerText = `Nyertes autó: ${data.auto}`;
            })
            .catch(error => console.error("Hiba történt: ", error));
    }, 4000);
}
    </script>
            <button onclick="closePopup()">Bezárás</button>
        </div>
    </div>
   
    <script>
        function showPopup() {
            document.getElementById("popupOverlay").style.display = "flex";
        }
        function closePopup(event) {
            document.getElementById("popupOverlay").style.display = "none";
        }
    </script>
</body>
</html>
