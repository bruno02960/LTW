<?php
    include('../session/session.php');
    include('../database/connection.php');

    if(!empty($_POST['listID']) && !empty($_POST['listName']))
    {
        $list = $conn->prepare('UPDATE toDoList SET name = :name WHERE toDoList.id = :id');
        if($list != null)
        {
            $listID = strip_tags($_POST['listID']);
            $listName = strip_tags($_POST['listName']);
            $list->bindParam(':id',$listID);
            $list->bindParam(':name', $listName);
            if($list->execute())
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
