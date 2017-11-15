<?php
    include('../includes/session.php');

    include('../database/connection.php');
    
    include('passing.php');

    if (isset($_POST['deleteListButton'])) 
    {
        $records = $conn->prepare('DELETE FROM toDoList WHERE id = :id');
        $records->bindParam(':id', $_POST['listID']);
        $records->execute();
        header("Location: ../main/index.php");
    }
  ?>