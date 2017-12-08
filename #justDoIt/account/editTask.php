<?php
    include('../includes/session.php');
    include('../database/connection.php');
    include('../templates/userinfo.php');

    if(!empty($_POST['taskID']))
    {
        $task = $conn->prepare('SELECT id, title, completed, expiring,description FROM task where id = :id');
        if($task != null)
        {
            $task->bindParam(':id', $_POST['taskID']);
            $task->execute();
            $task = $task->fetch(PDO::FETCH_ASSOC);
        }
    }

    include('../templates/header.php');
    include('../account/showEditTask.php');
    include('../templates/footer.php');
?>
