<?php
    include('../includes/session.php');
    include('../includes/redirectLoggedOut.php');
    include('../templates/userinfo.php');

    if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['name']))
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $name = $_POST['name'];
        if(empty($_POST['location']))
            $location = null;
        else
            $location = $_POST['location'];

        $sql = "UPDATE users SET username = :username, email = :email, name = :name, location = :location WHERE id = :id";
        $stmt = $conn->prepare($sql);
        if($stmt != null)
        {

            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':location', $location);
            $stmt->bindParam(':id', $_SESSION['user_id']);

            if($stmt->execute())
            {
                $user['username'] = $username;
                $user['email'] = $email;
                $user['name'] = $name;
                $user['birthday'] = $birthday;
                $user['location'] = $location;
                header("Location: ../account/profile.php");
            }
        }
    }

    include('../templates/header.php');
    include('editProfileForm.php');
    include('../templates/footer.php');
?>
