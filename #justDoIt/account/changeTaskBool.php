<?php
    include('../includes/session.php');
    include('../database/connection.php');

    if(!empty($_POST['completed']))
    {
    $q = $_POST['completed'];

    $sql = "UPDATE task SET completed = :completed WHERE id = :id";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':completed', $q);
    $stmt->bindParam(':id', 1);
    if($stmt->execute())
        {echo 1;
        return;}
    else
        {echo 2;
            return;}
    }

?>