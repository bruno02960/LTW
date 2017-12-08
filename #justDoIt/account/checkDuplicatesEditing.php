<?php
    include('../includes/session.php');
    include('../database/connection.php');

    $Email = $_POST['email'];
    $Username = $_POST['username'];
    $ID = $_SESSION['user_id'];

    if(!empty($Email) && !empty($Username) && isset($ID))
    {
        $query = $conn->prepare('SELECT * FROM users WHERE username = :username AND id != :id');
        if($query != null)
        {
            $query->bindParam(':username', $Username);
            $query->bindParam(':id', $ID);
            $query->execute();

            $queryResults = $query->fetchAll();

            if(count($queryResults) > 0)
            {
                echo -1;
                return;
            }

            $query = $conn->prepare('SELECT * FROM users WHERE email = :email AND id != :id');
            $query->bindParam(':email', $Email);
            $query->bindParam(':id', $ID);
            $query->execute();

            $queryResults = $query->fetchAll();

            if(count($queryResults) > 0)
            {
                echo -2;
                return;
            }

            echo 0;
        }
    }
?>
