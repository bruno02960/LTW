<?php

include('../templates/userinfo.php');

if(!empty($_POST['username']))
{   
        //Enter the new user in the database
        $sql = "UPDATE users SET username = :username WHERE id = :id";
        $stmt = $conn->prepare($sql);

        $username = $_POST['username'];
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':id', $_SESSION['user_id']);
    
        if($stmt->execute())
            $user['username'] = $username;
}

if(!empty($_POST['email']))
{   
        //Enter the new user in the database
        $sql = "UPDATE users SET email = :email WHERE id = :id";
        $stmt = $conn->prepare($sql);

        $email = $_POST['email'];
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $_SESSION['user_id']);
    
        if($stmt->execute())
            $user['email'] = $email;
}

if(!empty($_POST['name']))
{   
        //Enter the new user in the database
        $sql = "UPDATE users SET name = :name WHERE id = :id";
        $stmt = $conn->prepare($sql);

        $name = $_POST['name'];
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $_SESSION['user_id']);
    
        if($stmt->execute())
            $user['name'] = $name;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title> Edit Profile </title>
    <script
        src="https://code.jquery.com/jquery-3.2.1.js"
        integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous">
    </script>
</head>
<body>

    <div class = "header">
        <a href = "../main"> Your app Name </a>
    </div>

    <?php if(!empty($message)): ?>
        <p class="error"><?= $message ?> </p>
    <?php endif; ?>

    <p id = "errorMessage"  class = "hidden error"> </p>

    <form id = "editorForm" action="profileEditor.php" method = "POST">
        <label for="UsernameLabel">Username:</label>
        <input id = "usernameInput" type = "text" placeholder = "Username" name = "username" value = <?= $user['username'] ?>>
        <br>
        <label for="EmailLabel">Email:</label>
        <input id = "emailInput" type = "text" placeholder = "Email" name = "email" value = <?= $user['email'] ?>>
        <br>
        <label for="NameLabel">Name:</label>
        <input id = "nameInput" type = "text" placeholder = "Name" name = "name" value = <?= $user['name'] ?>>
        <br>
        <input id = "sendForm" type = "submit" class = "hidden">
        <button id = "editorSubmit" type = "button"> Submeter </button>
    </form>
</body>
<script>

    $('#editorForm input').keypress(function(e) {
        if (e.which == 13) {
            $('#editorSubmit').trigger('click');
            return false;
        }
    });

    $('#editorSubmit').click(function(e)
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

        if(email.length = '0')
        {
            var message = "Email can't be empty"
            $('#errorMessage').text(message);
            $('#errorMessage').removeClass('hidden');
            return;
        }

        if(name.length = '0')
        {
            var message = "Name can't be empty"
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