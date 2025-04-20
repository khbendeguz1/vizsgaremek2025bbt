<!DOCTYPE html>
<html lang="hu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BBT Autóbérlő - Kapcsolat</title>
    <link rel="stylesheet" href="style.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(135deg, #6a82fb, #fc5c7d) fixed;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-family: 'Arial', sans-serif;
            color: white;
            overflow-x: hidden;
        }

        body {
            color: #333;
            /* A szöveg sötét színe */
            background-color: #f4f4f4;
            /* Világos háttér a jobb olvashatóságért */
        }

        label,
        input,
        textarea {
            font-size: 16px;
            color: #333;
            /* A szöveg színe a címkék és beviteli mezők mellett */
        }


        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 30px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            border-radius: 15px;
            /* Lekerekített sarkok */
            margin: 10px;
        }

        nav ul {
            display: flex;
            list-style-type: none;
        }

        nav ul li {
            margin-left: 20px;
        }

        .error-message {
            font-size: 14px;
            color: red;
            margin-top: 5px;
        }

        nav ul li a {
            text-decoration: none;
            color: white;
            font-size: 18px;
        }

        .contact-container {
            padding: 50px 30px;
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            z-index: 1;
            position: relative;
        }

        .contact-container h2 {
            font-size: 36px;
            text-align: center;
            margin-bottom: 30px;
        }

        .contact-form {
            max-width: 600px;
            margin: 0 auto 40px;
            display: flex;
            flex-direction: column;
        }

        .contact-form input,
        .contact-form textarea {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            width: 100%;
        }

        .contact-form button {
            padding: 15px;
            background-color: #2c3e50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 18px;
        }

        .contact-form button:hover {
            background-color: #34495e;
        }

        .contact-info {
            text-align: center;
        }


        footer {
            text-align: center;
            padding: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            border-radius: 15px;
            /* Lekerekített sarkok */
            margin: 10px;
        }


        /* Add a background image with a cool effect */
        body::after {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: url('https://www.example.com/your-background-image.jpg');
            background-size: cover;
            background-position: center;
            opacity: 0.1;
            z-index: -1;
        }

        form {
            background-color: white;
            /* Form háttér színe */
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <h3>BBT Autóbérlő</h3>
        </div>
        <nav>
            <ul>
                <li><a href="welcome.php">Főoldal</a></li>
                <li><a href="#">Kapcsolat</a></li>
            </ul>
        </nav>
    </header>
    <br>
    <br>
    <section class="contact-container">
        <h2>Kapcsolatfelvétel</h2>
        <div class="contact-form">
            <form id="contactForm">
                <div>
                    <label for="name">Név:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div>
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div>
                    <label for="message">Üzenet:</label>
                    <textarea id="message" name="message" required></textarea>
                </div>
                <button type="submit" id="submitButton">Küldés</button>
            </form>

            <p id="responseMessage"></p>
        </div>
        <div class="contact-info">
            <h3>Elérhetőségeink</h3>
            <p><strong>Telefon:</strong> +36 1 234 5678</p>
            <p><strong>E-mail:</strong> info@bbtautoberlo.hu</p>
        </div>
    </section>
    <br>
    <br>
    <footer>
        <p>&copy; 2025 BBT Autóbérlő. Minden jog fenntartva.</p>
    </footer>

    <script>
        // Az űrlap és elemek lekérése
        const contactForm = document.getElementById("contactForm");
        const nameInput = document.getElementById("name");
        const emailInput = document.getElementById("email");
        const messageInput = document.getElementById("message");
        const submitButton = document.getElementById("submitButton");

        // Funkció az űrlap validálására
        function validateForm(event) {
            event.preventDefault(); // Megakadályozza az űrlap elküldését, amíg a validálás be nem fejeződik

            let isValid = true;
            let errorMessage = "";

            // Előző hibaüzenetek törlése
            document.querySelectorAll(".error-message").forEach((error) => {
                error.remove();
            });

            // Név validálása
            if (nameInput.value.trim() === "") {
                isValid = false;
                errorMessage = "Kérjük, add meg a neved!";
                displayError(nameInput, errorMessage);
            }

            // E-mail validálása
            if (emailInput.value.trim() === "") {
                isValid = false;
                errorMessage = "Kérjük, add meg az e-mail címed!";
                displayError(emailInput, errorMessage);
            } else if (!validateEmail(emailInput.value.trim())) {
                isValid = false;
                errorMessage = "Kérjük, érvényes e-mail címet adj meg!";
                displayError(emailInput, errorMessage);
            }

            // Üzenet validálása
            if (messageInput.value.trim() === "") {
                isValid = false;
                errorMessage = "Kérjük, add meg az üzenetet!";
                displayError(messageInput, errorMessage);
            }

            // Ha minden adat helyes, sikerüzenet megjelenítése
            if (isValid) {
                displaySuccessMessage();
            }
        }

        // Hibaüzenet megjelenítése
        function displayError(inputElement, message) {
            const errorDiv = document.createElement("div");
            errorDiv.classList.add("error-message");
            errorDiv.style.color = "red";
            errorDiv.innerText = message;
            inputElement.parentElement.appendChild(errorDiv);
        }

        // Sikerüzenet megjelenítése
        function displaySuccessMessage() {
            const successMessage = document.createElement("div");
            successMessage.style.color = "green";
            successMessage.innerText = "Köszönjük, hogy kapcsolatba léptél velünk! Hamarosan válaszolunk.";
            contactForm.appendChild(successMessage);

            // Az űrlap törlése a beküldés után
            nameInput.value = "";
            emailInput.value = "";
            messageInput.value = "";
        }

        // E-mail cím validálása
        function validateEmail(email) {
            const regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            return regex.test(email);
        }

        // Az űrlap beküldésekor a validálás
        contactForm.addEventListener("submit", validateForm);
    </script>
</body>

</html>