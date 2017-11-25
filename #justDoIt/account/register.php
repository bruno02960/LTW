<?php
    include('../includes/session.php');

    if(isset($_SESSION['user_id']))
        header("Location: ../main/index.php");

    include('../database/connection.php');

    if(!empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['location']) && !empty($_POST['birthday']) && !empty($_POST['password']) && !empty($_POST['confirm_password'])  && !empty($_POST['name']))
    {
        //Enter the new user in the database
        $sql = "INSERT INTO users (email,username, password, name, registerDate, birthday, location, profilePicture) VALUES (:email, :username, :password, :name, :registerDate, :birthday, :location, :profilePicture)";
        $stmt = $conn->prepare($sql);
        if($stmt != null)
        {
            
            $PW = $_POST['password'];
            $PWC = $_POST['confirm_password'];
            $UserName = $_POST['username'];
            $email = $_POST['email'];
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':username', $UserName);
            $PWHashed = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $stmt->bindParam(':password', $PWHashed);
            $stmt->bindParam(':name', $_POST['name']);
            $stmt->bindParam(':location', $_POST['location']);
            $birthday = strtotime($_POST['birthday']);
            $stmt->bindParam(':birthday', $birthday);
            $date = strtotime("now");
            $stmt->bindParam(':registerDate',  $date);
            $PPicDirectory = '../account/ProfilePictures/Default.PNG';
            $stmt->bindParam(':profilePicture', $PPicDirectory);

            if($stmt->execute())
            {
                $records = $conn->prepare('SELECT id FROM users WHERE username = :username');
                $records->bindParam(':username', $UserName);
                $records->execute();
                $results = $records->fetch(PDO::FETCH_ASSOC);
                $_SESSION['user_id'] = $results['id'];
                header("Location: ../main/index.php");
            }
            else
            {
                header("Location: ../account/register.php");
                echo('Unexpected error');
            }
        }

    }

    include('../templates/header.php');
    include('registerForm.php');
    include('../templates/footer.php');
?>
