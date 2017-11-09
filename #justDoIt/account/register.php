<?php

session_start();

if(isset($_SESSION['user_id'])):
    {
        header("Location: ../main/index.php");
    }
endif;

include('../database/connection.php');

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

  include('../templates/header.php');
  include('registerForm.php');
  include('../templates/footer.php');
?>
