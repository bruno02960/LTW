<?php
    include('../includes/session.php');
    include('../database/connection.php');
    include('passing.php');

    if($_POST['listName']!="")
    {
      $records = $conn->prepare('INSERT INTO toDoList (name, userid) VALUES (:name, :userid)');
      if($records != null)
      {
        $listname = strip_tags($_POST['listName']);
        $records->bindParam(':userid', $_SESSION['user_id']);
        $records->bindParam(':name', $listname);
        $records->execute();
        header("Location: ../main/index.php");
      }
    }
    else
      header("Location: ../main/index.php");
?>
