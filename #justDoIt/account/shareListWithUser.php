<?php
    include('../includes/session.php');
    include('../database/connection.php');
    include('../templates/userinfo.php');
    include('../templates/header.php');
    include('../includes/redirectLoggedOut.php');

    if(!empty($_POST['userID']) && !empty($_POST['listID']))
    {
        $records = $conn->prepare('INSERT INTO sharedList(userID, listID) Values (:userID, :listID)');
        $records->bindParam(':userID', $_POST['userID']);
        $records->bindParam(':listID', $_POST['listID']);
        if($records->execute())
        {
            header("Location: ../main/index.php");
        }
    }
    
    include('../templates/footer.php');
?>
