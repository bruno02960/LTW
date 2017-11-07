

</body>
    <?php if(!empty($message)): ?>
        <p class="error"><?= $message ?> </p>
    <?php endif; ?>

    <p id = "errorMessage"  class = "hidden error"> </p>
    <section id="register">
    <h1> Register </h1>

    <form id = "registerForm" action "register.php" method = "POST">
        <input id = "emailInput" type = "email" placeholder = "email" required name = "email"> <br>
        <input id = "usernameInput" type = "text" placeholder = "username" name = "username"> <br>
        <input id = "nameInput" type = "text" placeholder = "name" name = "name"> <br>
        <input id = "passwordInput" type = "password" placeholder = "password" name = "password"> <br>
        <input id = "confirmPasswordInput" type = "password" placeholder = "confirm password" name = "confirm_password"> <br>
        <input id = "sendForm" type = "submit" class = "hidden"> <br>
        <button id = "registerSubmit" type = "button"> Submit </button>
    </form>
  </section>
</body>
<script>

    $('#registerForm input').keypress(function(e) {
        if (e.which == 13) {
            $('#registerSubmit').trigger('click');
            return false;
        }
    });

    $('#registerSubmit').click(function(e)
    {
        $('#errorMessage').text('');
        $('#errorMessage').addClass('hidden');

        var email = $('#emailInput').val();
        var username = $('#usernameInput').val();
        var name = $('#nameInput').val();
        var PW = $('#passwordInput').val();
        var CPW = $('#confirmPasswordInput').val();
        var regex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)[a-zA-Z\\d]{8,72}$");

        if(username.length < '8')
        {
            var message = "Your Username Must Contain At Least 8 Characters!";
            $('#errorMessage').text(message);
            $('#errorMessage').removeClass('hidden');
            return;
        }

        if(!regex.test(PW))
        {
            var message = "Your password must contain a minimum of 8 characters, at least 1 uppercase letter, 1 lowercase letter 1 one number";
            $('#errorMessage').text(message);
            $('#errorMessage').removeClass('hidden');
            return;
        }
/*
        if(PW.length > 72)
        {
            var message = "Your password must have a minimum size of eight characters and a maximum of 72";
            $('#errorMessage').text(message);
            $('#errorMessage').removeClass('hidden');
            return;
        }*/

        if(PW != CPW)
        {
            var message = "The passwords don't match";
            $('#errorMessage').text(message);
            $('#errorMessage').removeClass('hidden');
            return;
        }

        $.ajax({
            type: "POST",
            url: "CheckIfExists.php",
            data: {
                'username': username,
                'email': email
            },
            success: function(response) {
                console.log(response);
                if(response == -1) {
                    var message = "This username is already in use!";
                    $('#errorMessage').text(message);
                    $('#errorMessage').removeClass('hidden');
                    return;
                } else if(response == -2) {
                    var message = "This email is already in use!";
                    $('#errorMessage').text(message);
                    $('#errorMessage').removeClass('hidden');
                    return;
                } else $('#sendForm').trigger('click');
            }
        });
    })
</script>
</html>
