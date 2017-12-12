<?php
  include('../includes/session.php');
  include('../database/connection.php');

  if(isset($_SESSION['user_id']))
  {
    $records = $conn->prepare('SELECT id, username,password FROM users WHERE id = :id');
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

      if(!empty($_SESSION['index']))
      {
        $index = $_SESSION['index'];
      }
      else
        $index = 0;

    }
  }

  include('updateList.php');
  include('../templates/header.php');
  include('../templates/frontpage.php');
  include('../templates/footer.php');
?>
