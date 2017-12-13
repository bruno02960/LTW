<?php
    include('../session/session.php');
    //generates a paired key for the specified form, using shar 256 as the encryption algorithm
    //the list name as the message to encrypt and the User Authentication Token as the key

    $tokenName = strip_tags($_POST['tokenName']);
    $token = $_POST['AuthToken'];

    $AuthToken = hash_hmac('sha256', "AuthRequest" , $_SESSION['UserAuthToken']);
    if ($token!=null)
    {
        if (!hash_equals($token,$AuthToken))
        {
            echo -3;
            return;
        }
    }
    else
    {
        echo -2;
        return;
    }

    if (isset($_SESSION['UserAuthToken']))
    {
        echo hash_hmac('sha256', $tokenName, $_SESSION['UserAuthToken']);
    }
    else
    {
        echo -1;
    }

    return;
?>
