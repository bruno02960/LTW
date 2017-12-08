<?php
    include('../includes/session.php');

    if(isset($_COOKIE[session_name()])):
        setcookie(session_name(), '', time()-7000000, '/');
    endif;

    if(isset($_COOKIE['login_user'])):
        setcookie('login_user', '', time()-7000000, '/');
    endif;

    session_unset();
    session_destroy();

    header("Location: ../main");
?>
