<?php
    include('../session/session.php');
    include('../database/connection.php');
    include('../profile/userinfo.php');

    $list = NULL;

    switch ($_GET['list'])
    {
      case "completed":
        $list = $conn->prepare('SELECT task.id, title, completed, expiring, description FROM task JOIN toDoList ON toDoListId = toDoList.id WHERE toDoList.userID = :id AND completed = "true"
                                UNION SELECT task.id, title, completed, expiring, description FROM task JOIN sharedList ON sharedList.userID = :id WHERE completed = "true"');
        if($list != null)
        {
            $list->bindParam(':id', $_SESSION['user_id']);
            $list->execute();
            $list = $list->fetchAll();
        }
        break;
      case "incomplete":
        $list = $conn->prepare('SELECT task.id, title, completed, expiring, description FROM task JOIN toDoList ON toDoListId = toDoList.id WHERE toDoList.userID = :id AND completed = "false"
                                UNION SELECT task.id, title, completed, expiring, description FROM task JOIN sharedList ON sharedList.userID = :id WHERE completed = "false"');
        if($list != null)
        {
            $list->bindParam(':id', $_SESSION['user_id']);
            $list->execute();
            $list = $list->fetchAll();
        }
        break;
      case "expiring":
        $list = $conn->prepare('SELECT task.id, title, completed, expiring, description FROM task JOIN toDoList ON toDoListId = toDoList.id WHERE toDoList.userID = :id AND completed = "false" AND (expiring - strftime("%s","now")) <= 259200
                                UNION SELECT task.id, title, completed, expiring, description FROM task JOIN sharedList ON sharedList.userID = :id WHERE completed = "false" AND (expiring - strftime("%s","now")) <= 259200');
        if($list != null)
        {
            $list->bindParam(':id', $_SESSION['user_id']);
            $list->execute();
            $list = $list->fetchAll();
        }
        break;
      default:
        $list = $conn->prepare('SELECT task.id, title, completed, expiring, description FROM task JOIN toDoList ON toDoListId = toDoList.id WHERE toDoList.userID = :id AND title LIKE :it
                                UNION SELECT task.id, title, completed, expiring, description FROM task JOIN sharedList ON sharedList.userID = :id WHERE title LIKE :it');
        if($list != null)
        {
            $seachList = strip_tags($_GET['list']);
            $search = "%" . $seachList . "%";
            $list->bindParam(':id', $_SESSION['user_id']);
            $list->bindParam(':it', $search);
            $list->execute();
            $list = $list->fetchAll();
        }
        break;
    }

    include('../templates/header.php');
    include('../list_management/listDisplay.php');
    include('../templates/footer.php');
?>
