<?php
    include('../database/connection.php');
    include('../includes/session.php');

    $string = $_POST['str'];
    echo strip_tags($string);
    return;
?>