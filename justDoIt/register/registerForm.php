<p id = "errorMessage"> </p>
<section id="register">
    <h2> Register </h2>

    <form id = "registerForm" action = "register.php" method = "POST" onkeypress="return keyListener(event)" enctype="multipart/form-data">
        <input id = "emailInput" type = "email" placeholder = "email" name = "email" required> <br>
        <input id = "usernameInput" type = "text" placeholder = "username" name = "username" required> <br>
        <input id = "nameInput" type = "text" placeholder = "name" name = "name" required> <br>
        <input id = "dateInput" type = "text" placeholder = "birthday (dd-mm-yyyy)" name = "birthday" required> <br>
        <input id = "locationInput" type = "text" placeholder = "location (optional)" name = "location"> <br>
        <input id = "passwordInput" type = "password" placeholder = "password" name = "password" required>
        <p id="strLog">No Password</p> <br>
        <input id = "confirmPasswordInput" type = "password" placeholder = "confirm password" name = "confirm_password" required> <br>
        <div id="uploadPhoto">
            <input class = "hidden" type="file" name="fileToUpload" id="fileToUpload" onchange="pressed()">
            <label id="uploadLabel" for="fileToUpload"> Choose a profile picture... (optional) </label> <br> <br>
            <input id = "sendForm" type = "submit" class = "hidden">
        </div>
        <button id = "registerSubmit" type = "button"> Submit </button>
    </form>

</section>

<script src="registerForm.js"></script>
