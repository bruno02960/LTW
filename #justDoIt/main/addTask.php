<?php
    include('../includes/session.php');

    include('../database/connection.php');

    include('passing.php');

    if (isset($_POST['addTaskButton'])) 
    {
        if($_POST['taskName']!="") 
        {
            $records = $conn->prepare('INSERT INTO task (title, completed, toDoListId, expiring) VALUES (:title, "false", :toDoListId, :expiring)');
            $records->bindParam(':toDoListId', $_POST['listID']);
            $records->bindParam(':title', $_POST['taskName']);
            $expiring = strtotime($_POST['taskDate']);
            $records->bindParam(':expiring', $expiring);
            $records->execute();
            header("Location: ../main/index.php");
        }
    }
  ?>