<?php

include('../templates/userinfo.php');

?> 

<!DOCTYPE html>
<html>
<head>
    <title> Login Below </title>
</head>
<body>

    <div class = "header">
        <a href = "../main"> Your app Name </a>
    </div>

    <div class="profile">
        <p> <?= $user['username']; ?> </p>
        <p> <?= $user['email']; ?> </p>
        <p> <?= $user['name']; ?> </p>
        <p> <?= $user['registerDate']; ?> </p>
        <a href = "profileEditor.php"> Edit Profile </a>
    </div>

</body>
</html>