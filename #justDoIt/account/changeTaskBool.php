<?php
    include('../includes/session.php');
    include('../database/connection.php');

    if(!empty($_POST['completed']) && !empty($_POST['task_id']))
    {
        $completedBool = $_POST['completed'];
        $id = $_POST['task_id'];

        $sql = "UPDATE task SET completed = :completed WHERE id = :id";
        $stmt = $conn->prepare($sql);
        
        $stmt->bindParam(':completed', $completedBool);
        $stmt->bindParam(':id',$id );
        
        if($stmt->execute())
        {
            return 0;
        }
        else
        {
            return -1;
        }
    }
?>