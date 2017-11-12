<?php
    include('../database/connection.php');
    include("passing.php");

    function object_to_array($data)
    {
        if(is_array($data) || is_object($data))
        {
            $result = array();
     
            foreach($data as $key => $value) {
                $result[$key] = $this->object_to_array($value);
            }
     
            return $result;
        }
     
        return $data;
    }

    $index = $_POST['index'];

    if($allList[$index]==NULL){
        echo -1;
        return;
    }

    $selectedList = $allList[$index];
    
    $records = $conn->prepare('SELECT id, title, completed, expiring FROM task WHERE toDoListId = :id');
    $records->bindParam(':id', $selectedList['id']);
    $records->execute();
    $results = $records->fetchAll();
    
    $tasks = NULL;
    
    if(count($results) > 0)
    {
        $tasks = $results;

        $arr = array();
        foreach($tasks as $task){
            $toEncode = object_to_array($task);
            $encoded = json_encode($toEncode);
            array_push($arr,$encoded);
        }
        if($arr != $tasks){
            echo json_encode($arr);
            return;
        }else{
            echo -2;
            return;
        }
    }else{
        echo -3;
        return;
    }
?>