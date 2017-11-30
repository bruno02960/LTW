<?php
    include('../includes/session.php');
    include('../database/connection.php');
    include('updateList.php');

    if(!empty($_POST['listID']))
    {
        $ListID = $_POST['listID'];

        if($_POST['taskName']!="" && $_POST['taskDate']!="") 
        {
            $records = $conn->prepare('INSERT INTO task (title, completed, toDoListId, expiring) VALUES (:title, "false", :toDoListId, :expiring)');
            if($records != null)
            {
                $records->bindParam(':toDoListId', $ListID);
                $taskName = strip_tags($_POST['taskName']);
                $records->bindParam(':title', $taskName);
                $expiring = strtotime($_POST['taskDate']);
                $records->bindParam(':expiring', $expiring);
                $records->execute();
            }
        }
        header("Location: ../main/index.php");
    }
?>
