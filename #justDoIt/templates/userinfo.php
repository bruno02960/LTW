<?php

include('../includes/session.php');

include('../database/connection.php');

if(isset($_SESSION['user_id']))
  {
    $records = $conn->prepare('SELECT id, username, email, name, registerDate, location, birthday FROM users WHERE id = :id');
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
