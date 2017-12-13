<?php
    include('../session/session.php');
    include('../database/connection.php');

    $records = $conn->prepare(' SELECT id, name,userID FROM toDoList WHERE userID = :id 
                                UNION
                                SELECT toDoList.id, toDoList.name || " - " || users.username AS name, toDoList.userID
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
            $lists = $results;
            array_push($lists,$_SESSION['user_id']);
            echo json_encode($lists);
            return;
        }
    }
?>
