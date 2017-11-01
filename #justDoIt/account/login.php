<?php

session_start();

if(isset($_SESSION['user_id'])):
    {
        header("Location: ../main/index.php");
    }
endif;

require '../database/connection.php';

if(!empty($_POST['username']) && !empty($_POST['password'])):
    
    $records = $conn->prepare('SELECT id, username,password FROM users WHERE username = :username');
    $records->bindParam(':username', $_POST['username']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $message = '';

    if(count($results) > 0 && password_verify($_POST['password'], $results['password'])):
    {
        $_SESSION['user_id'] = $results['id'];
        header("Location: ../main/index.php");
    }
    else: 
        $message = 'Sorry, those credentials do not match';
    endif;
    
endif;
?>

<!DOCTYPE html>
<html>
<head>
    <title> Login Below </title>
</head>
<body>

    <div class = "header">
        <a href = "../main"> Your app Name </a>
    </div>

    <?php if(!empty($message)): ?>
        <p><?= $message ?> </p>
    <?php endif; ?>

    <h1> Login </h1>
    <span> or <a href = "register.php"> register here </a> </span>



    <form action "login.php" method = "POST">
        <input type = "text" placeholder = "username" name = "username">
        <input type = "password" placeholder = "password" name = "password">
        <input type = "submit">
    </form>
</body>
</html>