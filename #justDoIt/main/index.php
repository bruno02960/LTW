<?php

session_start();

require '../database/connection.php';

if(isset($_SESSION['user_id']))
  {
    $records = $conn->prepare('SELECT id, username,password FROM users WHERE id = :id');
    $records->bindParam('id:', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = NULL;

    if(count($results) > 0)
    {
      $user = $results;
    }
  }

?> 

<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>#justDoIt</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <header>
      <h1>#justDoIt</h1>
      <div class="header">
      </div>

      <?php if(isset($user)): ?>

        <br /> Welcome <?= $user['username']; ?>
        <br /> <br /> You are sucessfully logged in!
        <br /><br />

        <a href = "../account/logout.php"> Logout? </a>

      <?php else: ?>

        <h1> Please Login Or Register </h1>
        <a href="../account/register.php">Register</a>
        <a href="../account/login.php">Login</a>

      <?php endif; ?>

    </header>
    <nav id="menu">
    </nav>
    <aside id="lists">
    </aside>
    <section>
    </section>
    <footer>
      <p>&copy; #justDoIt, LTW</p>
    </footer>
  </body>
</html>
