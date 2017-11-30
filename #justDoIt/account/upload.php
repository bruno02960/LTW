<?php

    include('../includes/session.php');
    include('../database/connection.php');
    include('../includes/redirectLoggedOut.php');
    $target_dir = "../account/profilePictures/";
    if($_POST['file'] == null)
    {
        return -1;
    } 

    $target_file = $target_dir . $_POST['file'];
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    $check = $_POST['size'];
    if($check != null) 
    {
        $uploadOk = 1;
    } 
    else 
    {
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        return -1;
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_POST['file'], $target_file)) 
        {
            //$original = imagecreatefrompng($target_file);
            //$width = imagesx($original);
            //$height = imagesy($original);

            $sql = "UPDATE users SET profilePicture = :profilePicture WHERE id = :id";

            $stmt = $conn->prepare($sql);
            
            if($stmt != null)
            {
                $stmt->bindParam(':profilePicture', $target_file);
                $stmt->bindParam(':id', $_SESSION['user_id']);
            
                if($stmt->execute())
                {
                    $user['profilePicture'] = $target_file;
                    return 0;
                }
                else
                {
                    return -1;
                } 
            }
            else
            {
                return -1;
            } 
        } 
        else 
        {
            return -1;
        }
    }
    return 0;
?>