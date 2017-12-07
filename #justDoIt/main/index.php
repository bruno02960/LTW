<?php
  include('../includes/session.php');
  include('../database/connection.php');
  include('passing.php');

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

        //creates the primary auth token for the session
        if (empty($_SESSION['UserAuthToken'])) {
          if (function_exists('mcrypt_create_iv')) {
            $_SESSION['UserAuthToken'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
          }else {
            $_SESSION['UserAuthToken'] = bin2hex(openssl_random_pseudo_bytes(32));
          }
        }
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
