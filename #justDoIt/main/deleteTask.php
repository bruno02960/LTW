<?php
    include('../includes/session.php');
    include('../database/connection.php');

    $records = $conn->prepare('DELETE FROM task WHERE id = :id');
    if($records != null)
    {
        $records->bindParam(':id', $_POST['task_id']);
        if($records->execute())
        {
            echo 0;
            return;
        }
    }
    echo -1;
    return;
?>
