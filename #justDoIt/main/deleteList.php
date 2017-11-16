<?php
    include('../includes/session.php');
    include('../database/connection.php');

    $records = $conn->prepare('DELETE FROM toDoList WHERE id = :id');
    $records->bindParam(':id', $_POST['listID']);
    if($records->execute())
    {
        if($_SESSION['index'] != 0)
            $_SESSION['index']--;
        header("Location: ../main/index.php");
    }

?>