<?php
    include('../session/session.php');
    include('../database/connection.php');

    include('../security/checkAuthHash.php');
    if(checkAuthHash($_POST['AuthToken'],$_POST['tokenName'])!=1)
    {
        echo "CSRF ATTEMPT";
        return -1;
    }

    if($_POST['listName'] != "")
    {
      $records = $conn->prepare('INSERT INTO toDoList (name, userid) VALUES (:name, :userid)');
      if($records != null)
      {
        $listname = strip_tags($_POST['listName']);
        $records->bindParam(':userid', $_SESSION['user_id']);
        $records->bindParam(':name', $listname);
        $records->execute();
        $_SESSION['index'] = 0;
        header("Location: ../main");
      }
    }
    else
    {
      header("Location: ../main");
    }
?>
