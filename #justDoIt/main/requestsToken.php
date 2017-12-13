<?php

    include('../session/session.php');
    //generates a paired key for the specified form,using shar 256 as the encryption algorithm
    //the list name as the message to encrypt and the User Authentication Token as the key

    $listName = strip_tags($_POST['listName']);
    if(isset($_SESSION['UserAuthToken'])){
        echo hash_hmac('sha256', $listName, $_SESSION['UserAuthToken']);
    }else{
        echo -1;
    }
    return;

?>