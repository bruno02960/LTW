<?php
    include('../session/session.php');
    include('../database/connection.php');

    if(!empty($_POST['taskID']) && !empty($_POST['taskTitle']) && !empty($_POST['taskExpDate']))
    {
        $expiring = strtotime($_POST['taskExpDate']);
        $task = $conn->prepare('UPDATE task SET title = :title, completed = :completed, expiring = :expiring, description = :description WHERE task.id = :id');
        if($task != null)
        {

            $task->bindParam(':id', $_POST['taskID']);
            $task->bindParam(':title', $_POST['taskTitle']);
            $status = $_POST['status'];
            $task->bindParam(':completed', $status);

            $task->bindParam(':expiring', $expiring);
            $task->bindParam(':description', $_POST['taskDescription']);
            if($task->execute())
            {
                echo 0;
                return;
            }
            else
            {
                echo -1;
                return;
            }
        }
    }
    else
    {
        echo -1;
        return;
    }
?>
