<?php
    session_start();
    
    if(isset($_SESSION['user_id']))
    {
      $records = $conn->prepare('SELECT username,email,name FROM users WHERE username = :username AND email = :email AND name = :name');
      $records->bindParam(':username', $_SESSION['username']);
      $records->bindParam(':email', $_SESSION['email']);
      $records->bindParam(':name', $_SESSION['name']);
      $records->execute();
      $results = $records->fetch(PDO::FETCH_ASSOC);
  
      $user = NULL;
  
      if(count($results) > 0)
      {
        $user = $results;
      }
    }

    require '../database/connection.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title> Login Below </title>
</head>
<body>

    <div class = "header">
        <a href = "../main"> Your app Name </a>
    </div>

    <form action="/action_page.php">
        <label for="Username">Username:</label>
        <input id = "usernameInput" type = "text" placeholder = "username" name = "username">
        <input type="submit" value="Submit">
    </form>

    </form>
</body>
</html>