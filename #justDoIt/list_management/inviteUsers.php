<?php
  include('../session/session.php');
  include('../database/connection.php');
  include('../profile/userinfo.php');
  include('../templates/header.php'); ?>

  

  <?php if(!empty($_POST['user'])): ?>
    <h1 style="margin-left: 30px;"> Searching users with <?php echo $_POST['user'] ?> </h1>
  <?php else: ?>
    <h1 style="margin-left: 30px;"> Searching all users </h1>
  <?php endif; ?>

  <?php

    include('../security/checkAuthHash.php');
    if(checkAuthHash($_POST['AuthToken'],$_POST['tokenName'])!=1)
    {
        echo "CSRF ATTEMPT";
        return -1;
    }

    $users = $conn->prepare('SELECT id, username, email FROM users WHERE id != :id AND username LIKE :username');
    $user = strip_tags($_POST['user']);
    $search = "%" .  $user . "%";
    $users->bindParam(':id', $_SESSION['user_id']);
    $users->bindParam(':username', $search);
    if($users->execute())
    {
        $users = $users->fetchAll();
        if($users == null)
        {
            echo '<p style = "margin-left: 1em;" class = "error"> No users found </p>';
        }
        else
        {
  ?>

  <table class = "tasks" style="margin-left: 30px;">
  <tbody>
    <tr>
      <th class="status arrowCursor">Username</th>
      <th class="task arrowCursor">Email</th>
      <th class="deltete task"></th>
    </tr>

  <?php
      $checkMark = "&#10010;";
      foreach( $users as $user)
      {
          echo '<tr>
                  <td class = "status">' . $user['username'] . '</td>
                  <td class="task">' . $user['email'] . '</td>
                  <td class="delete">
                      <a class = "buttonCursor" onclick="fillInviteForm(this);" id="userID' . $user['id'] . '/listID' . $_POST['listID'] . '">' . $checkMark . ' </a>
                  </td>
                </tr>' ;
      }
      echo '</tbody>';
      echo '</table>';
      echo '<br>';
      }
  }
  ?>

  <button style= "margin-left: 2em;" type ="submit" onclick = "window.location='../main';"> Go Back </button> <br> <br>

  <form id = "inviteUserForm" action="shareListWithUser.php" method="POST">
      <input type = "hidden" id = "userID" name = "userID">
      <input type = "hidden" id = "listID" name = "listID">
  </form>

<script src='../list_management/inviteUsers.js'> </script>

<?php include('../templates/footer.php'); ?>
