<?php
    include('../database/connection.php');
    include('../session/session.php');

    include('../security/checkAuthHash.php');
    if(checkAuthHash($_POST['AuthToken'],$_POST['tokenName'])!=1)
    {
        echo "CSRF ATTEMPT";
        return -1;
    }

    $index = $_POST['index'];
    $allList = $_SESSION['allLists'];
    if (!array_key_exists($index,$allList))
    {
        echo -1;
        return;
    }

    $selectedList = $allList[$index];

    $records = $conn->prepare('SELECT id, title, completed, expiring, toDoListId,description FROM task WHERE toDoListId = :id');
    if ($records != null)
    {
        $records->bindParam(':id', $selectedList['id']);
        $records->execute();
        $results = $records->fetchAll();

        $tasks = NULL;

            $tasks = $results;

            $arr = array();
            foreach($tasks as $task)
            {
                $task['title'] = strip_tags($task['title']);
                $encoded = json_encode($task);
                array_push($arr,$encoded);
            }
                echo json_encode($arr);
                return;
    }
?>
