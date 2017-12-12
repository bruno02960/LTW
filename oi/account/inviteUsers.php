<?php
  include('../includes/session.php');
  include('../database/connection.php');
  include('../templates/userinfo.php');
  include('../templates/header.php'); ?>

  <h1 style="margin-left: 30px;"> <?php echo $_POST['listName'] ?> </h1>

  <?php
    $users = $conn->prepare('SELECT id, username, email FROM users WHERE id != :id AND username LIKE :username');
    $search = "%" . $_POST['user'] . "%";
    $users->bindParam(':id', $_SESSION['user_id']);
    $users->bindParam(':username', $search);
    if($users->execute())
    {
        $users = $users->fetchAll();
        if($users == null)
        {
            echo '<p class = "error"> No users found </p>';
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
          echo '
            <tr>
              <td class = "status">' . $user['username'] . '</td>
              <td class="task">' . $user['email'] . '</td>
              <td class="delete">
                  <a class = "buttonCursor" onclick="fillInviteForm(this);" id="userID' . $user['id'] . '/listID' . $_POST['listID'] . '">' . $checkMark . ' </a>
              </td>
            </tr>
         
        ' ;
      }
      echo ' </tbody>';
      echo '</table>';
      echo '<br>';
      }
  }
  ?>

    <form id = "inviteUserForm" action="../account/shareListWithUser.php" method="POST">
        <input type = "hidden" id = "userID" name = "userID"> 
        <input type = "hidden" id = "listID" name = "listID">
    </form>

<script>

  function fillInviteForm(UserList)
  {
    var userID = (UserList.id.substr(0,UserList.id.indexOf('/'))).substr(6);
    var listID = UserList.id.split('/')[1].substr(6);

    document.getElementById("userID").value = userID;
    document.getElementById("listID").value = listID;
    document.getElementById("inviteUserForm").submit();
  }

</script>

<?php include('../templates/footer.php'); ?>
