<?php

    include('../templates/userinfo.php');

    if(!empty($_POST['username']) && !empty($_POST['username']) && !empty($_POST['username']))
    {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $name = $_POST['name'];

        $sql = "UPDATE users SET username = :username, email = :email, name = :name WHERE id = :id";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':birthday', $birthday);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':id', $_SESSION['user_id']);

        if($stmt->execute())
        {
            $user['username'] = $username;
            $user['email'] = $email;
            $user['name'] = $name;
            $user['birthday'] = $birthday;
            $user['location'] = $location;
        }
        header("Location: ../account/profile.php");
    }

    include('../templates/header.php');
    include('editProfileForm.php');
    include('../templates/footer.php');
?>
