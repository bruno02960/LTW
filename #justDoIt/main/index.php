<?php

session_start();

require '../database/connection.php';

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
  }

?> 

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

        <a href = "../account/logout.php"> Logout? </a> <br />
        <a href = "../account/profile.php"> Profile </a>

      <?php else: ?>

        <a href="../account/register.php">Register</a>
        <a href="../account/login.php">Login</a>

      <?php endif; ?>

      </div>

    </header>
    <nav id="menu">
      <ul>
        <li><a href="index.html">Completed</a></li>
        <li><a href="index.html">To Complete</a></li>
        <li><a href="index.html">Expiring</a></li>
      </ul>
    </nav>
    <aside id="lists">
      Morbi justo mauris, venenatis quis libero ut, rhoncus suscipit lectus. Phasellus pharetra bibendum diam, non consequat nunc porta tincidunt. Interdum et malesuada fames ac ante ipsum primis in faucibus. Etiam vel pretium purus, quis mattis diam. Praesent augue eros, dignissim sed dolor ac, dictum cursus dolor. Morbi ac enim aliquam, faucibus tortor eu, luctus massa. Sed magna nisl, malesuada sed est ut, euismod ornare nisl. Vestibulum scelerisque diam sit amet est laoreet convallis. Praesent fringilla dapibus justo, nec vulputate magna mollis ut. Vivamus in felis volutpat est condimentum elementum ac eget ligula. Aliquam commodo, mi ac elementum pellentesque, nulla mi auctor nisi, non pharetra neque leo at augue. Nam cursus libero non mattis vehicula. Donec pretium diam tincidunt diam sagittis, eget convallis quam rutrum.

Sed maximus mi nec purus eleifend gravida. Aliquam vitae ipsum quis erat commodo faucibus. Nunc sagittis tincidunt erat, non iaculis augue sodales sed. Vivamus arcu magna, tincidunt a nulla vel, condimentum mattis nisl. Etiam semper libero eu est aliquam faucibus. Donec id semper dui, sit amet pulvinar enim. Duis elementum dapibus ipsum, mollis facilisis quam efficitur ac. Cras tristique enim vitae lectus cursus, a feugiat felis sagittis. Cras efficitur nec ex vitae dignissim. Nullam bibendum cursus imperdiet. Suspendisse ut nunc sapien.

Pellentesque rutrum lorem in erat imperdiet sollicitudin. Ut dapibus, tellus sed semper luctus, libero tortor pulvinar ante, quis ultricies sapien purus sed orci. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc mollis lectus orci, ac porta turpis ullamcorper eget. Nam orci ante, malesuada non augue at, ullamcorper tincidunt ipsum. Praesent metus risus, fermentum sed dictum et, scelerisque vitae justo. Vestibulum feugiat elementum sodales. Pellentesque consectetur, ante eget ullamcorper congue, purus mi venenatis leo, eu dapibus magna magna vitae nibh. Aenean scelerisque vitae sem at vehicula.

Donec quam ipsum, feugiat ut aliquet eu, aliquet quis nisi. Sed vitae luctus massa. Nulla at sapien in magna aliquam malesuada. Praesent porttitor, nulla at sollicitudin accumsan, ipsum orci volutpat metus, non commodo massa velit mollis risus. Donec eu sodales ligula. Mauris tincidunt iaculis dui. Donec venenatis tempor justo, scelerisque malesuada turpis lacinia sit amet.

Duis vitae purus vitae nibh sodales euismod. Pellentesque id mauris orci. Proin malesuada odio vitae semper tincidunt. Maecenas leo turpis, vestibulum nec felis eu, auctor pellentesque lacus. Integer sagittis lectus a turpis hendrerit congue. Duis sagittis enim sapien, ac bibendum metus gravida fringilla. Phasellus in neque eu neque imperdiet dignissim. Duis vulputate luctus erat, vel consequat odio faucibus eu. Vivamus in erat sit amet magna iaculis convallis sed eget tortor. Suspendisse suscipit libero sed turpis blandit rhoncus. Morbi et nulla at dolor mattis aliquam. Duis dignissim, massa in lacinia aliquam, quam velit auctor nisl, et tristique nisl diam at ligula. Proin sed congue erat, nec venenatis mi. Curabitur dignissim mollis velit, at commodo enim maximus ac.
    </aside>
    <section id="list">


      <?php if(isset($user)): ?>

      <?php else: ?>

        <h1> Please Login Or Register </h1>

      <?php endif; ?>
    </section>
    <footer>
      <p>&copy; #justDoIt, LTW</p>
    </footer>
  </body>
</html>
