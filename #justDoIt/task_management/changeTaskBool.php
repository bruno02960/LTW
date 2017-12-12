<?php
    include('../session/session.php');
    include('../database/connection.php');

    if(!empty($_POST['completed']) && !empty($_POST['task_id']))
    {
        $completedBool = $_POST['completed'];
        $id = $_POST['task_id'];

        $sql = "UPDATE task SET completed = :completed WHERE id = :id";
        $stmt = $conn->prepare($sql);
        if($stmt != null)
        {

            $stmt->bindParam(':completed', $completedBool);
            $stmt->bindParam(':id',$id );

            if($stmt->execute())
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
    else {
        echo -1;
        return;
      }
?>
