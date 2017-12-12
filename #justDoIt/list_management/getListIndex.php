<?php
    include('../session/session.php');
    include('../database/connection.php');
    include('updateList.php');

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