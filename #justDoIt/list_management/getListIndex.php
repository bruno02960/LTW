<?php
    include('../session/session.php');
    include('../database/connection.php');
    include('updateList.php');

    include('../security/checkAuthHash.php');
    if(checkAuthHash($_POST['AuthToken'],$_POST['tokenName'])!=1)
    {
        echo "CSRF ATTEMPT".$_POST['AuthToken']." ".$_POST['tokenName'];
        return -1;
    }

    $ListID = $_POST['listID'];
    for ($i = 0; $i < count($lists); $i++) 
    {
        if($lists[$i]['id'] == $ListID)
        {
            $index = $i;
            $_SESSION['index'] = $index;
        }
    }
?>