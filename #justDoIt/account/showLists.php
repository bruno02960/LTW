<?php
    include('../includes/session.php');
    include('../database/connection.php');
    include('../templates/userinfo.php');

    $list = NULL;

    switch($_GET['list']){
      case "completed":
        $list = $conn->prepare('SELECT task.id, title, completed, expiring, description FROM task JOIN toDoList ON toDoListId = toDoList.id WHERE toDoList.userID = :id AND completed = "true"');
        if($list != null)
        {
            $list->bindParam(':id', $_SESSION['user_id']);
            $list->execute();
            $list = $list->fetchAll();
        }
        break;
      case "incomplete":
        $list = $conn->prepare('SELECT task.id, title, completed, expiring, description FROM task JOIN toDoList ON toDoListId = toDoList.id WHERE toDoList.userID = :id AND completed = "false"');
        if($list != null)
        {
            $list->bindParam(':id', $_SESSION['user_id']);
            $list->execute();
            $list = $list->fetchAll();
        }
        break;
      case "expiring":
        $list = $conn->prepare('SELECT task.id, title, completed, expiring, description FROM task JOIN toDoList ON toDoListId = toDoList.id WHERE toDoList.userID = :id AND completed = "false" AND (expiring - strftime("%s","now")) <= 259200');
        if($list != null)
        {
            $list->bindParam(':id', $_SESSION['user_id']);
            $list->execute();
            $list = $list->fetchAll();
        }
        break;
      default:
        $list = $conn->prepare('SELECT task.id, title, completed, expiring, description FROM task JOIN toDoList ON toDoListId = toDoList.id WHERE toDoList.userID = :id AND title LIKE :it');
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
    include('../account/listDisplay.php');
    include('../templates/footer.php');
?>
