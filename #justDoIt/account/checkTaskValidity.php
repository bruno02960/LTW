<?php
    include('../includes/session.php');
    include('../database/connection.php');

    if(!empty($_POST['taskID']) && !empty($_POST['taskTitle']) && !empty($_POST['taskExpDate']))
    {
        $date = explode('-',$_POST['taskExpDate']);
        $day = intval($date[0]);
        $month = intval($date[1]);
        $year = intval($date[2]);

        
        if($day > 31)
        {
            echo -2;
            return;
        }
        else if($month > 12)
        {
            echo -3;
            return;
        }
        else
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
    }
    else
    {
        echo -1;
        return;
    }

?>