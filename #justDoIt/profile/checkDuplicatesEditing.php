<?php
    include('../session/session.php');
    include('../database/connection.php');

    $email = $_POST['email'];
    $username = $_POST['username'];
    $id = $_SESSION['user_id'];

    if(!empty($email) && !empty($username) && isset($id))
    {
        $query = $conn->prepare('SELECT * FROM users WHERE username = :username AND id != :id');
        if($query != null)
        {
            $username = strip_tags($username);
            $email = strip_tags($email);
            $query->bindParam(':username', $username);
            $query->bindParam(':id', $id);
            $query->execute();

            $queryResults = $query->fetchAll();

            if(count($queryResults) > 0)
            {
                echo -1;
                return;
            }

            $query = $conn->prepare('SELECT * FROM users WHERE email = :email AND id != :id');
            $query->bindParam(':email', $email);
            $query->bindParam(':id', $id);
            $query->execute();

            $queryResults = $query->fetchAll();

            if(count($queryResults) > 0)
            {
                echo -2;
                return;
            }

            echo 0;
            return;
        }
    }
?>
