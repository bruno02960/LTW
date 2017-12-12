<?php
    include('../session/session.php');
    include('../database/connection.php');
    include('../profile/userinfo.php');
    include('../templates/header.php');
    include('../session/redirectLoggedOut.php');

    if(!empty($_POST['userID']) && !empty($_POST['listID']))
    {
        $records = $conn->prepare('INSERT INTO sharedList(userID, listID) Values (:userID, :listID)');
        $records->bindParam(':userID', $_POST['userID']);
        $records->bindParam(':listID', $_POST['listID']);
        if($records->execute())
        {
            header("Location: ../main");
        }
    }
    
    include('../templates/footer.php');
?>
