<?php
    include('../session/session.php');
    include('../database/connection.php');

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
