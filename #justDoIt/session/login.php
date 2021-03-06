<?php
    include('../session/session.php');
    include('../session/redirectLoggedIn.php');
    include('../database/connection.php');
    
    if(!empty($_POST['username']) && !empty($_POST['password']))
    {
        $records = $conn->prepare('SELECT id, username,password FROM users WHERE username = :username');
        if($records != null)
        {
            $username = strip_tags($_POST['username']);
            $records->bindParam(':username', $username);
            $records->execute();
            $results = $records->fetch(PDO::FETCH_ASSOC);

            $message = '';

            if(count($results) > 0 && password_verify($_POST['password'], $results['password']))
            {
                $_SESSION['user_id'] = $results['id'];
                header("Location: ../main/index.php");
            }
            else
            {
                $message = 'Sorry, those credentials do not match';
            }
        }
    }

    include('../templates/header.php');
    include('loginForm.php');
    include('../templates/footer.php');
?>
