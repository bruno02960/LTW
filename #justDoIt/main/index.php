<?php

session_start();

require '../database/connection.php';

if(isset($_SESSION['user_id']))
  {
    $records = $conn->prepare('SELECT id, username,password FROM users WHERE id = :id');
    $records->bindParam('id:', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = NULL;

    if(count($results) > 0)
    {
      $user = $results;
    }
  }

  include('../templates/header.php');
  include('../templates/frontpage.php');
  include('../templates/footer.php');

?>
