<?php

session_start();

if(isset($_SESSION['user_id'])):
    {
        header("Location: ../main/index.php");
    }
endif;

require '../database/connection.php';

$message = ' ';

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

    $errorFound = false;

    if (strlen($PW) < '8') {
        $message = "Your Password Must Contain At Least 8 Characters!";
        $errorFound = true;
    }
    elseif(!preg_match("#[0-9]+#",$PW)) {
        $message = "Your Password Must Contain At Least 1 Number!";
        $errorFound = true;
    }
    elseif(!preg_match("#[A-Z]+#",$PW)) {
        $message = "Your Password Must Contain At Least 1 Capital Letter!";
        $errorFound = true;
    }
    elseif(!preg_match("#[a-z]+#",$PW)) {
        $message = "Your Password Must Contain At Least 1 Lowercase Letter!";
        $errorFound = true;
    }
    elseif($PW != $PWC)
    {
        $message = "The two passwords don't match";
        $errorFound = true;
    }

    if(!filter_var($email, FILTER_VALIDATE_EMAIL))
    {
        $message = "Invalid Email";
        $errorFound = true;
    }

    if(strlen($UserName) < '8')
    {
        $message = "Your Username Must Contain At Least 8 Characters!";
        $errorFound = true;
    }

    if(!$errorFound)
    {
        if($stmt->execute())
            $message = 'Sucessfully created new user';
        else
            $message = 'Email or Username already in use';
    }
endif;

  include('../templates/header.php');
  include('../templates/footer.php');
?>

    <?php if(!empty($message)): ?>
        <p><?= $message ?> </p>
    <?php endif; ?>

    <h1> Register </h1>

    <form action "register.php" method = "POST">
        <input type = "text" placeholder = "email" name = "email"> <br> <br>
        <input type = "text" placeholder = "username" name = "username"> <br> <br>
        <input type = "text" placeholder = "name" name = "name"> <br> <br>
        <input type = "password" placeholder = "password" name = "password"> <br> <br>
        <input type = "password" placeholder = "confirm password" name = "confirm_password"> <br> <br>
        <input type = "submit">
    </form>
