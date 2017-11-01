<?php

session_start();

if(isset($_SESSION['user_id'])):
    {
        header("Location: ../main/index.php");
    }
endif;

require '../database/connection.php';

$message = ' ';

if(!empty($_POST['email']) && !empty($_POST['password'])):
    
    //Enter the new user in the database
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':email', $_POST['email']);
    $PWHashed = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $PWHashed);

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
        <input type = "password" placeholder = "password" name = "password">
        <input type = "password" placeholder = "confirm password" name = "confirm_password">
        <input type = "submit">
    </form>
</body>
</html>