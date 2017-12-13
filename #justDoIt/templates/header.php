<!DOCTYPE html>
<html lang="en-US">
  <head>
    <title>#justDoIt</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/responsiveness.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:800" rel="stylesheet">
    </head>
    <body>
    <header>
      <?php date_default_timezone_set("UTC"); ?>
      <a href="../main">
        <h1>#justDoIt</h1>
      </a>

      <div class="header">
        <?php if(isset($user)): ?>

        <a href = "../profile/profile.php"> Profile </a>
        <a href = "../session/logout.php"> Logout </a>

        <?php else: ?>

        <a href="../register/register.php">Register</a>
        <a href="../session/login.php">Login</a>

        <?php endif; ?>
      </div>
    </header>
