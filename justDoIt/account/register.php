<?php

session_start();

if(isset($_SESSION['user_id'])):
    {
        header("Location: ../main/index.php");
    }
endif;

require '../database/connection.php';

$message = ' ';

if(!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['name'])):
    
    //Enter the new user in the database
    $sql = "INSERT INTO users (email,username, password, name, registerDate) VALUES (:email, :username, :password, :name, :registerDate)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':email', $_POST['email']);
    $stmt->bindParam(':username', $_POST['username']);
    $PWHashed = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $PWHashed);
    $stmt->bindParam(':name', $_POST['name']);
    $date = date('Y-m-d H:i:s');
    $stmt->bindParam(':registerDate',  $date);

    if($stmt->execute()):
        $message = 'Sucessfully created new user';
    else:
        $message = 'Sorry there must have been an issue creating your account';
    endif;
endif;
?>

<!DOCTYPE html>
<html>
<head>
    <title> Register Below </title>
</head>
<body>

    <div class = "header">
        <a href = "../main"> Your app Name </a>
    </div>

    <?php if(!empty($message)): ?>
        <p><?= $message ?> </p>
    <?php endif; ?>

    <h1> Register </h1>
    <span> or <a href = "login.php"> login here </a> </span>
    


    <form action "register.php" method = "POST">
        <input type = "text" placeholder = "email" name = "email">
        <input type = "text" placeholder = "username" name = "username">
        <input type = "text" placeholder = "name" name = "name">
        <input type = "password" placeholder = "password" name = "password">
        <input type = "password" placeholder = "confirm password" name = "confirm_password">
        <input type = "submit">
    </form>
</body>
</html>