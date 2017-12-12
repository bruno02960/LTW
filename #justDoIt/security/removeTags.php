<?php
    include('../database/connection.php');
    include('../session/session.php');

    $string = $_POST['str'];
    echo strip_tags($string);
    return;
?>