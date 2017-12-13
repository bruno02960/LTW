<?php
    include('../session/session.php');
    include('../database/connection.php');
    include('../profile/userinfo.php');

    include('../security/checkAuthHash.php');
    if(checkAuthHash($_POST['AuthToken'],$_POST['tokenName'])!=1)
    {
        echo "CSRF ATTEMPT";
        return -1;
    }

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
    include('../task_management/showEditTask.php');
    include('../templates/footer.php');
?>
