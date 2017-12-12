<?php
    include('../database/connection.php');

    $Email = $_POST['email'];
    $Username = $_POST['username'];
    if(!empty($Email) && !empty($Username))
    {
        $query = $conn->prepare('SELECT * FROM users WHERE username = :username');
        if($query != null)
        {
            $query->bindParam(':username', $Username);
            $query->execute();
            
            $queryResults = $query->fetchAll();

            if(count($queryResults) > 0)
            {
                echo -1;
                return;
            }

            $query = $conn->prepare('SELECT * FROM users WHERE email = :email');
            $query->bindParam(':email', $Email);
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