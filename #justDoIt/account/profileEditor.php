<?php

include('../templates/userinfo.php');

if(!empty($_POST['username']))
{
        //Enter the new user in the database
        $sql = "UPDATE users SET username = :username WHERE id = :id";
        $stmt = $conn->prepare($sql);

        $username = $_POST['username'];
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':id', $_SESSION['user_id']);

        if($stmt->execute())
            $user['username'] = $username;
}

if(!empty($_POST['email']))
{
        //Enter the new user in the database
        $sql = "UPDATE users SET email = :email WHERE id = :id";
        $stmt = $conn->prepare($sql);

        $email = $_POST['email'];
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':id', $_SESSION['user_id']);

        if($stmt->execute())
            $user['email'] = $email;
}

if(!empty($_POST['name']))
{
        //Enter the new user in the database
        $sql = "UPDATE users SET name = :name WHERE id = :id";
        $stmt = $conn->prepare($sql);

        $name = $_POST['name'];
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $_SESSION['user_id']);

        if($stmt->execute())
            $user['name'] = $name;
}


  include('../templates/header.php');
  include('editProfileForm.php');
  include('../templates/footer.php');
?>
