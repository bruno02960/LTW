
   <?php 
    include('../includes/session.php');
    include('../database/connection.php');
    include('../templates/userinfo.php');
    include('../templates/header.php'); ?>

    <h1> <?php echo $_POST['listName'] ?> </h1>

    <?php
        $users = $conn->prepare('SELECT id, username, email FROM users WHERE id != :id AND username LIKE :username');
        $search = "%" . $_POST['list'] . "%";
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

    <table class = "tasks">
    <tbody>
      <tr>
        <th class="id">ID</th>
        <th class="status arrowCursor">Username</th>
        <th class="task arrowCursor">Email</th>
      </tr>

    <?php        
        foreach( $users as $user)
        {
            echo '<form action="../account/shareListWithUser.php" method="POST">
            <tr>
            <td class="id"> <input type = "hidden" name = "userID" value = "' . $user['id'] . '" >  </td>
            <td class="id"> <input type = "hidden" name = "listID" value = "' . $_POST['listID'] . '" >  </td>
            <td class = "status">' . $user['username'] . '</td>
            <td class="task">' . $user['email'] . '</td>
            <td> <input class = "buttonCursor" type = "submit" value = "+"> </td>
            </form>' ;
        }
        }
    }
    ?>
    </tbody>
    </table>

   <?php include('../templates/footer.php'); ?>

