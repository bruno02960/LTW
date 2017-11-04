<?php

session_start();

require '../database/connection.php';

if(isset($_SESSION['user_id']))
  {
    $records = $conn->prepare('SELECT id, username,email,name,registerDate FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = NULL;

    if(count($results) > 0)
    {
      $user = $results;
    }
  }

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

    <div class="profile">
        <p> <?= $user['username']; ?> </p>
        <p> <?= $user['email']; ?> </p>
        <p> <?= $user['name']; ?> </p>
        <p> <?= $user['registerDate']; ?> </p>
        <a href = "profileEditor.php"> Edit Profile </a>
    </div>

</body>
</html>