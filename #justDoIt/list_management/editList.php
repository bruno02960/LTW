<?php
    include('../session/session.php');
    include('../database/connection.php');
    include('../profile/userinfo.php');

    if(!empty($_POST['listID']))
    {
        $list = $conn->prepare('SELECT id, name FROM toDoList where id = :id');
        if($list != null)
        {
            $list->bindParam(':id', $_POST['listID']);
            $list->execute();
            $list = $list->fetch(PDO::FETCH_ASSOC);
        }
    }

    include('../templates/header.php');
    include('../list_management/showEditList.php');
    include('../templates/footer.php');
?>
