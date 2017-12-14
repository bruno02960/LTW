<?php
    include('../session/session.php');
    include('../database/connection.php');
    include('../security/checkAuthHash.php');

    if(checkAuthHash($_POST['AuthToken'],$_POST['tokenName'])!=1)
    {
        return -1;
    }

    $records = $conn->prepare('DELETE FROM task WHERE id = :id');
    if($records != null)
    {
        $records->bindParam(':id', $_POST['task_id']);
        if($records->execute())
        {
            return 0;
        }
    }
    
    return -1;
?>
