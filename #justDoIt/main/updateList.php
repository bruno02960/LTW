<?php
    include('../includes/session.php');
    include('../database/connection.php');
    include('passing.php');

    $records = $conn->prepare('SELECT id, name FROM toDoList WHERE userID = :id');
    $records->bindParam(':id', $_SESSION['user_id']);

    if($records->execute())
    {   
        $results = $records->fetchAll();
        $lists = NULL;

        // if(count($results) > 0)
        //{
        $_SESSION['allLists'] = $results;
        $lists = $results;
        //}

        if(count($lists) != 0)
        {
            $records = $conn->prepare('SELECT id, title, completed, expiring, toDoListId FROM task WHERE toDoListId = :id');
            $records->bindParam(':id', $lists[$index]['id']);
            $records->execute();
            $results = $records->fetchAll();

            $tasks = NULL;

            if(count($results) > 0)
            {
                $tasks = $results;
            }
        }
        else
            $tasks = null;
    }
?>