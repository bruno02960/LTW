<?php

session_start();

if(isset($_SESSION['user_id'])):
    {
        header("Location: ../main/index.php");
    }
endif;

require '../database/connection.php';

if(!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])  && !empty($_POST['name'])):
    
    //Enter the new user in the database
    $sql = "INSERT INTO users (email,username, password, name, registerDate) VALUES (:email, :username, :password, :name, :registerDate)";
    $stmt = $conn->prepare($sql);

    $PW = $_POST['password'];
    $PWC = $_POST['confirm_password'];
    $UserName = $_POST['username'];
    $email = $_POST['email'];
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':username', $UserName);
    $PWHashed = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $PWHashed);
    $stmt->bindParam(':name', $_POST['name']);
    $date = date('Y-m-d H:i:s');
    $stmt->bindParam(':registerDate',  $date);

    if($stmt->execute())
            $message = 'Sucessfully created new user';
    else
            $message = 'Unexpected error';
    
endif;
?>

<!DOCTYPE html>
<html>
<head>
    <title> Register Below </title>
    <script
        src="https://code.jquery.com/jquery-3.2.1.js"
        integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
        crossorigin="anonymous">
    </script>
</head>
<style>
    .hidden {
        display: none;
    }
    .error {
        color: red;
    }
</style>
<body>

    <div class = "header">
        <a href = "../main"> Your app Name </a>
    </div>

    <?php if(!empty($message)): ?>
        <p class="error"><?= $message ?> </p>
    <?php endif; ?>

    <p id = "errorMessage"  class = "hidden error"> </p>

    <h1> Register </h1>
    <span> or <a href = "login.php"> login here </a> </span>
    


    <form id = "registerForm" action "register.php" method = "POST">
        <input id = "emailInput" type = "email" placeholder = "email" required name = "email">
        <input id = "usernameInput" type = "text" placeholder = "username" name = "username">
        <input id = "nameInput" type = "text" placeholder = "name" name = "name">
        <input id = "passwordInput" type = "password" placeholder = "password" name = "password">
        <input id = "confirmPasswordInput" type = "password" placeholder = "confirm password" name = "confirm_password">
        <input id = "sendForm" type = "submit" class = "hidden">
        <button id = "registerSubmit" type = "button"> Submeter </button>
    </form>
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
        var regex = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)[a-zA-Z\\d]{8,}$");

        if(username.length < '8')
        {
            var message = "Your Username Must Contain At Least 8 Characters!";
            $('#errorMessage').text(message);
            $('#errorMessage').removeClass('hidden');
            return;
        }  

        if(!regex.test(PW)) 
        {
            var message = "Your password must contain a minimum of eight characters, at least one uppercase letter, one lowercase letter and one number";
            $('#errorMessage').text(message);
            $('#errorMessage').removeClass('hidden');
            return;
        }

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