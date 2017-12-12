<?php
  include('../session/session.php');
  include('../database/connection.php');

  if(isset($_SESSION['user_id']))
  {
    $records = $conn->prepare('SELECT id, username, email, name, registerDate, profilePicture, birthday, location  FROM users WHERE id = :id');
    if($records != null)
    {
      $records->bindParam(':id', $_SESSION['user_id']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);

      $user = NULL;

      if(count($results) > 0)
      {
        $user = $results;
      }
    }
  }
?>
