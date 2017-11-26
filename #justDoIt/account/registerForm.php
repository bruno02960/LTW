<body>
    <p id = "errorMessage"> </p>
    <section id="register">
        <h1> Register </h1>

        <form id = "registerForm" action "register.php" method = "POST" onkeypress="return keyListener(event)">
            <input id = "emailInput" type = "email" placeholder = "email" required name = "email" required> <br>
            <input id = "usernameInput" type = "text" placeholder = "username" name = "username" required> <br>
            <input id = "nameInput" type = "text" placeholder = "name" name = "name" required> <br>
            <input id = "dateInput" type = "text" placeholder = "birthday (mm/dd/year)" name = "birthday" required> <br>
            <input id = "locationInput" type = "text" placeholder = "location" name = "location" required> <br>
            <input id = "passwordInput" type = "password" placeholder = "password" name = "password" required> <br>
            <input id = "confirmPasswordInput" type = "password" placeholder = "confirm password" name = "confirm_password" required> <br>
            <input id = "sendForm" type = "submit" class = "hidden"> <br>
            <button id = "registerSubmit" type = "button"> Submit </button>
        </form>
    </section>
</body>

<script src="registerForm.js"></script>
</html>
