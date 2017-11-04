<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>#justDoIt</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style.css" rel="stylesheet">
  </head>
  <body>
    <header>
      <h1>#justDoIt</h1>
      <div class="header">

      <?php if(isset($user)): ?>

        <br /> Welcome <?= $user['username']; ?>
        <br /> <br /> You are sucessfully logged in!
        <br /><br />

        <a href = "../account/logout.php"> Logout? </a>

      <?php else: ?>

        <a href="../account/register.php">Register</a>
        <a href="../account/login.php">Login</a>

      <?php endif; ?>

      </div>

    </header>
