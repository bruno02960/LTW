<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>#justDoIt</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../style.css" rel="stylesheet">
    <link href="../responsiveness.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:800" rel="stylesheet">
    </head>
    <body>
    <header>
      <a href="../main">
        <h1>#justDoIt</h1>
      </a>

      <div class="header">
        <?php if(isset($user)): ?>

        <a href = "../account/profile.php"> Profile </a>
        <a href = "../account/logout.php"> Logout </a>

        <?php else: ?>

        <a href="../account/register.php">Register</a>
        <a href="../account/login.php">Login</a>

        <?php endif; ?>
      </div>
    </header>
