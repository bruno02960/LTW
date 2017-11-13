<body>
    <p id = "errorMessage"> </p>
    <section id="register">
        <h1> Register </h1>

        <form id = "registerForm" action "register.php" method = "POST" onkeypress="return keyListener(event)">
            <input id = "emailInput" type = "email" placeholder = "email" required name = "email"> <br>
            <input id = "usernameInput" type = "text" placeholder = "username" name = "username"> <br>
            <input id = "nameInput" type = "text" placeholder = "name" name = "name"> <br>
            <input id = "dateInput" type = "text" placeholder = "birthday (mm/dd/year)" name = "birthday"> <br>
            <input id = "locationInput" type = "text" placeholder = "location" name = "location"> <br>
            <input id = "passwordInput" type = "password" placeholder = "password" name = "password"> <br>
            <input id = "confirmPasswordInput" type = "password" placeholder = "confirm password" name = "confirm_password"> <br>
            <input id = "sendForm" type = "submit" class = "hidden"> <br>
            <button id = "registerSubmit" type = "button"> Submit </button>
        </form>
    </section>
</body>

<script>
    var submitButton = document.getElementById("registerSubmit");
    var form = document.getElementById("registerForm");

    function keyListener(e) 
    {
        if (e.keyCode == 13) 
        {
            submitButton.click();
            return false;
        }
    }
    
    submitButton.addEventListener("click", function(event) 
    {
        event.preventDefault();
        document.getElementById("errorMessage").classList.value = '';
        document.getElementById("errorMessage").classList.add('hidden');
        document.getElementById("errorMessage").classList.add('error');

        var email = document.getElementById("emailInput").value;
        var username = document.getElementById("usernameInput").value;
        var name = document.getElementById("nameInput").value;
        var birthday = document.getElementById("dateInput").value;
        var location = document.getElementById("locationInput").value;
        var PW = document.getElementById("passwordInput").value;
        var CPW = document.getElementById("confirmPasswordInput").value;
        var regexPW = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)[a-zA-Z\\d]{8,72}$");
        var regexBDay = new RegExp("^((0?[1-9]|1[012])[- /.](0?[1-9]|[12][0-9]|3[01])[- /.](19|20)?[0-9]{2})*$");

        if(username.length < '8')
        {
            var message = "Your Username Must Contain At Least 8 Characters!";
            document.getElementById("errorMessage").innerHTML = message;
            document.getElementById("errorMessage").classList.remove('hidden');
            return;
        }

        if(name.length == '0')
        {
            var message = "Name can't be empty";
            document.getElementById("errorMessage").innerHTML = message;
            document.getElementById("errorMessage").classList.remove('hidden');
            return;
        }

        if(location.length == '0')
        {
            var message = "Location can't be empty";
            document.getElementById("errorMessage").innerHTML = message;
            document.getElementById("errorMessage").classList.remove('hidden');
            return;
        }

        if(!regexBDay.test(birthday))
        {
            var message = "Invalid birthday format [MM/DD/YYYY]";
            document.getElementById("errorMessage").innerHTML = message;
            document.getElementById("errorMessage").classList.remove('hidden');
            return;
        }

        if(!regexPW.test(PW))
        {
            var message = "Your password must contain a minimum of 8 characters, at least 1 uppercase letter, 1 lowercase letter 1 one number";
            document.getElementById("errorMessage").innerHTML = message;
            document.getElementById("errorMessage").classList.remove('hidden');
            return;
        }

        if(PW != CPW)
        {
            var message = "The passwords don't match";
            document.getElementById("errorMessage").innerHTML = message;
            document.getElementById("errorMessage").classList.remove('hidden');
            return;
        }

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() 
        {
            if (xhttp.readyState == 4 && xhttp.status == 200) 
            {
                if(xhttp.responseText == -1) 
                {
                    var message = "This username is already in use!";
                    document.getElementById("errorMessage").innerHTML = message;
                    document.getElementById("errorMessage").classList.remove('hidden');
                    return;
                } 
                else if(xhttp.responseText == -2) 
                {
                    var message = "This email is already in use!";
                    document.getElementById("errorMessage").innerHTML = message;
                    document.getElementById("errorMessage").classList.remove('hidden');
                    return;
                } 
                else 
                    document.getElementById("sendForm").click();
            }
        };

        xhttp.open("POST", "checkDuplicatesRegister.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("username=" + username + "&email=" + email);
    });
</script>
</html>
