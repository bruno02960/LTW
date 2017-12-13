<?php
    include('../database/connection.php');

    $email = strip_trags($_POST['email']);
    $username = strip_trags($_POST['username']);
    if(!empty($email) && !empty($username))
    {
        $query = $conn->prepare('SELECT * FROM users WHERE username = :username');
        if($query != null)
        {
            $query->bindParam(':username', $username);
            $query->execute();

            $queryResults = $query->fetchAll();

            if(count($queryResults) > 0)
            {
                echo -1;
                return;
            }

            $query = $conn->prepare('SELECT * FROM users WHERE email = :email');
            $query->bindParam(':email', $email);
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
