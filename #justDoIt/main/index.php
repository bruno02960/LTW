<?php
  include('../session/session.php');
  include('../database/connection.php');

  if(isset($_SESSION['user_id']))
  {
    if (function_exists('mcrypt_create_iv'))
    {
      $_SESSION['UserAuthToken'] = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
    }
    else
    {
      $_SESSION['UserAuthToken'] = bin2hex(openssl_random_pseudo_bytes(32));
    }

    $_SESSION['AuthRequestToken'] = hash_hmac('sha256', "AuthRequest" , $_SESSION['UserAuthToken']);
    
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

  include('../list_management/updateList.php');
  include('../templates/header.php');
  include('../list_management/frontpage.php');
  include('../templates/footer.php');
?>
