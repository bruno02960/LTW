<body>
  <section id="editProfile">
  <h1> Edit Profile </h1>
    <?php if(!empty($message)): ?>
        <p class="error"><?= $message ?> </p>
    <?php endif; ?>

    <p id = "errorMessage"  class = "hidden error"> </p>

    <form id = "editorForm" action="profileEditor.php" method = "POST">
        <label for="UsernameLabel">Username:</label> <br>
        <input id = "usernameInput" type = "text" placeholder = "Username" name = "username" value = <?= $user['username'] ?>> <br>
        <label for="EmailLabel">Email:</label> <br>
        <input id = "emailInput" type = "text" placeholder = "Email" name = "email" value = <?= $user['email'] ?>> <br>
        <label for="NameLabel">Name:</label> <br>
        <input id = "nameInput" type = "text" placeholder = "Name" name = "name" value = <?= $user['name'] ?>> <br>
        <input id = "sendForm" type = "submit" class = "hidden"> <br>
        <button id = "editProfileSubmit" type = "button"> Submit </button>
    </form>
  </section>
</body>
<script>

    $('#editorForm input').keypress(function(e) {
        if (e.which == 13) {
            $('#editorSubmit').trigger('click');
            return false;
        }
    });

    $('#editProfileSubmit').click(function(e)
    {
        $('#errorMessage').text('');
        $('#errorMessage').addClass('hidden');

        var email = $('#emailInput').val();
        var username = $('#usernameInput').val();
        var name = $('#nameInput').val();

        if(username.length < '8')
        {
            var message = "Your Username Must Contain At Least 8 Characters!";
            $('#errorMessage').text(message);
            $('#errorMessage').removeClass('hidden');
            return;
        }

        if(email.length == '0')
        {
            var message = "Email can't be empty"
            $('#errorMessage').text(message);
            $('#errorMessage').removeClass('hidden');
            return;
        }

        if(name.length == '0')
        {
            var message = "Name can't be empty"
            $('#errorMessage').text(message);
            $('#errorMessage').removeClass('hidden');
            return;
        }

        $.ajax({
            type: "POST",
            url: "checkDuplicatesEditing.php",
            data: {
                'username': username,
                'email': email
            },
            success: function(response) {
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
