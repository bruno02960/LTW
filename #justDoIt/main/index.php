<?php

include('../includes/session.php');

include('../database/connection.php');

if(isset($_SESSION['user_id']))
  {
    $records = $conn->prepare('SELECT id, username,password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = NULL;

    if(count($results) > 0)
    {
      $user = $results;
    }

    $records = $conn->prepare('SELECT id, name FROM toDoList WHERE userid = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetchAll();

    $lists = NULL;

    if(count($results) > 0)
    {
      $lists = $results;
    }

    $selectedList = $lists[0];

    $records = $conn->prepare('SELECT id, title, completed, expiring FROM task WHERE toDoListId = :id');
    $records->bindParam(':id', $selectedList['id']);
    $records->execute();
    $results = $records->fetchAll();

    $tasks = NULL;

    if(count($results) > 0)
    {
      $tasks = $results;
    }
  }

  if (isset($_POST['deleteListButton'])) {
    $records = $conn->prepare('DELETE FROM toDoList WHERE id = :id');
    $records->bindParam(':id', $selectedList['id']);
    $records->execute();
    header("Refresh:0");
  }

  if (isset($_POST['addListButton'])) {
    if($_POST['listName']!="") {
      $records = $conn->prepare('INSERT INTO toDoList (name, userid) VALUES (:name, :userid)');
      $records->bindParam(':userid', $_SESSION['user_id']);
      $records->bindParam(':name', $_POST['listName']);
      $records->execute();
      header("Refresh:0");
    }
  }

  if (isset($_POST['addTaskButton'])) {
    if($_POST['taskName']!="") {
      $records = $conn->prepare('INSERT INTO task (title, completed, toDoListId, expiring) VALUES (:title, "false", :toDoListId, :expiring)');
      $records->bindParam(':toDoListId', $selectedList['id']);
      $records->bindParam(':title', $_POST['taskName']);
      $expiring = strtotime($_POST['taskDate']);
      $records->bindParam(':expiring', $expiring);
      $records->execute();
      header("Refresh:0");
    }
  }

  include('../templates/header.php');
  include('../templates/frontpage.php');
  include('../templates/footer.php');

?>
