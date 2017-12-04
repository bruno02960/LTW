<?php
    include('../includes/session.php');
    include('../database/connection.php');

    $records = $conn->prepare('SELECT id, name FROM toDoList WHERE userID = :id 
                                UNION
                                SELECT toDoList.id, toDoList.name || " - " || users.username AS name 
                                FROM toDoList 
                                JOIN sharedList ON sharedList.listID = toDoList.id AND sharedList.userID = :id
                                JOIN users ON toDoList.userID = users.id
                                ORDER BY toDoList.id DESC');
    if($records != null)
    {
        $records->bindParam(':id', $_SESSION['user_id']);

        if($records->execute())
        {
            $results = $records->fetchAll();
            $_SESSION['allLists'] = $results;
            $lists = $results;

            if(count($lists) != 0)
            {
                $records = $conn->prepare('SELECT id, title, completed, expiring, toDoListId, description FROM task WHERE toDoListId = :id');
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
    }
?>
