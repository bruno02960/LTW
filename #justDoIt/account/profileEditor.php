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
        $stmt->bindParam(':id', $_SESSION['user_id']);

        if($stmt->execute())
        {
            $user['username'] = $username;
            $user['email'] = $email;
            $user['name'] = $name;
        }
    }

    include('../templates/header.php');
    include('editProfileForm.php');
    include('../templates/footer.php');
?>
