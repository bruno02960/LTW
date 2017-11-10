<?php

include('../includes/session.php');

include('../database/connection.php');

if(isset($_SESSION['user_id']))
  {
    $records = $conn->prepare('SELECT id, username,password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = NULL;

    if(count($results) > 0)
    {
      $user = $results;
    }

    $records = $conn->prepare('SELECT name FROM toDoList WHERE userid = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetchAll();

    $lists = NULL;

    if(count($results) > 0)
    {
      $lists = $results;
    }
  }

  include('../templates/header.php');
  include('../templates/frontpage.php');
  include('../templates/footer.php');

?>
