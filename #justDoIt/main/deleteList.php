<?php
    include('../includes/session.php');
    include('../database/connection.php');

    $records = $conn->prepare('SELECT userID FROM toDoList WHERE userID = :userID AND id = :id');
    $records->bindParam(':userID', $_SESSION['user_id']);
    $records->bindParam(':id', $_POST['listID']);
    if($records->execute())
    {
        $results = $records->fetchAll();
        if(count($results) > 0)
        {
            $lists = $conn->prepare('DELETE FROM toDoList WHERE id = :id');
            if($lists != null)
            {
                $lists->bindParam(':id', $_POST['listID']);
                if($lists->execute())
                {
                    if($_SESSION['index'] != 0)
                        $_SESSION['index']--;
        
                    $tasksList = $conn->prepare('DELETE FROM task WHERE toDoListId = :id');
                    if($tasksList != null)
                    {
                        $tasksList->bindParam(':id', $_POST['listID']);
                        $tasksList->execute();
                    }
            
                    $sharedList = $conn->prepare('DELETE FROM sharedList WHERE listID = :id');
                    if($sharedList != null)
                    {
                        $sharedList->bindParam(':id', $_POST['listID']);
                        $sharedList->execute();
                    }

                    header("Location: ../main/index.php");
                }
            }
        }
        else
        {
            $records = null;
            $records = $conn->prepare('SELECT userID FROM sharedList WHERE userID = :userID AND listID = :id');
            $records->bindParam(':userID', $_SESSION['user_id']);
            $records->bindParam(':id', $_POST['listID']);
            
            if($records->execute())
            {
                $results = $records->fetch(PDO::FETCH_ASSOC);
               
                if(count($results) > 0)
                {
                    $sharedList = $conn->prepare('DELETE FROM sharedList WHERE listID = :id AND userID = :userID');
                    if($sharedList != null)
                    {
                        if($_SESSION['index'] != 0)
                            $_SESSION['index']--;

                        $userID = $results['userID'];
                        $sharedList->bindParam(':id', $_POST['listID']);
                        $sharedList->bindParam(':userID', $userID);
                        $sharedList->execute();
                        header("Location: ../main/index.php");
                    }
                }
            }
        }
    }
?>
