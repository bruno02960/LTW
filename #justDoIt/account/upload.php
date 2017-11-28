<?php

    include('../includes/session.php');
    include('../database/connection.php');

    $target_dir = "../account/profilePictures/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) 
    {
        $uploadOk = 1;
    } 
    else 
    {
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
        {
            $original = imagecreatefromjpeg($originalFileName);
            $width = imagesx($original);
            $height = imagesy($original);

            $sql = "UPDATE users SET profilePicture = :profilePicture WHERE id = :id";

            $stmt = $conn->prepare($sql);
            
            if($stmt != null)
            {
                $stmt->bindParam(':profilePicture', $target_file);
                $stmt->bindParam(':id', $_SESSION['user_id']);
            
                if($stmt->execute())
                {
                    $user['profilePicture'] = $target_file;
                    header("Location: ../account/profile.php");
                }
            }
        } 
        else 
        {
            echo "Sorry, there was an error uploading your file.";
        }
    }
?>