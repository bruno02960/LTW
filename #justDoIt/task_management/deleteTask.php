<?php
    include('../session/session.php');
    include('../database/connection.php');

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
