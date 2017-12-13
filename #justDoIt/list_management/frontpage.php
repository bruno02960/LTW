<?php if(isset($user)): ?>
  <nav id="menu">
    <ul>
      <li>
        <form action="../list_management/showLists.php" id="searchForm">
          <input type="text" name="list" id="searchImp" placeholder="Search Tasks">
          <input type="hidden" id="searchAuthToken" name="AuthToken">
          <input type="hidden" id="searchID" value="searchForm" name="tokenName">
        </form>
      </li>
      <li><a href="../list_management/showLists.php?list=completed">Completed</a></li>
      <li><a href="../list_management/showLists.php?list=incomplete">Incomplete</a></li>
      <li><a href="../list_management/showLists.php?list=expiring">Expiring</a></li>
    </ul>
  </nav>

  <p id = "message" class = "hidden"> </p>

  <aside id="lists">
    <h2> To-do lists </h2>
    <table class="lists" id="listsTable">
      <?php
      if($lists!=NULL)
      {
        foreach( $lists as $list)
        {
          $name = strip_tags($list['name']);
          echo '
                  <tr>
                  <td class="id">' . $list['id']. '</td>
                  <td class="name buttonCursor">' . $name. '</td>';
                  if ($list['userID'] == $_SESSION['user_id'])
                  {
                    echo '<td class="deltete task"><a class = "buttonCursor left_align" onclick="editList(this);" id="list'. $list['id'] . '"> &#9998;  </a> </td>';
                  }
                  else
                    echo '<td class="deltete task"> </td>';
                  echo '</tr>
               ';
        }
      }
      ?>
    </table>
        <form id="addListForm" action = "../list_management/addList.php" method="POST">
          <input type="text" maxlength="25" id="listnameID" name="listName" placeholder="List name" required><br>
          <input class = "buttonCursor" type="submit" name = "addListButton" value="Add list">
          <input id = "addListAuthToken" type="hidden" name="AuthToken">
          <input id = "addListID" type="hidden" value="addListForm" name="tokenName">
        </form>

        <form id = "editListForm" class = "id" action="../list_management/editList.php" method = "POST">
          <input type="hidden" id = "editListID" name = "listID">
          <input type="hidden" id="editListAuthToken" name="AuthToken">
          <input type="hidden" id="editListFormID" value="editListForm" name="tokenName">
        </form>
  </aside>

  <?php
    if($lists == null)
    {
      $toHide = "hidden";
    }
    else
      $toHide = " ";
  ?>

  <section id="list">
  <h2 id = "ListName" class = "<?= $toHide ?>"> <?= strip_tags($lists[$index]['name'])?> </h2>
  <div style="overflow-x:auto;" >
  <table class="tasks <?= $toHide ?>" id="taskTable">
  <tbody>
        <?php
          if($tasks != null)
          {
            echo '<tr>
                    <th class="id">ID</th>
                    <th class="status arrowCursor" ></th>
                    <th class="task arrowCursor">Task</th>
                    <th class="expDate arrowCursor">Expiration Date </th>
                    <th id="descriptionHead" class="task arrowCursor">Description </th>
                    <th class="deltete task"></th>
                  </tr>';

        $row = 0;
        foreach( $tasks as $task)
        {
          $taskRow = $task['id'];
          $data = "";
          $diffDay = 0;
          $diffMonth = 0;
          $diffYear = 0;
          if($task['expiring']!=NULL)
          {
            $data = date('d-m-Y', $task['expiring']);
          }

          $title =  strip_tags($task['title']);

          echo '<tr>
          <td class="id verticalTop">' . $task['id']. '</td>';

          if($task['completed'] == "true")
          {
             $checkMark = "&#10004;";
             $htmlstring = '';
             $editTaskString='';

             echo '<td class="status verticalTop">' . $editTaskString . $htmlstring . $checkMark . ' </td>';
          }
          else
          {
             $checkMark = "";
             if ($lists[$index]['userID'] == $_SESSION['user_id'])
             {
                $htmlstring = '<input type="checkbox" style=" margin-left: -13px; float:right;" onclick="completeTask(this);" id="task' . $taskRow . '/index' . $index .'">';
                $editTaskString='<a class = "buttonCursor left_align" onclick="editTask(this);" id="task' . $taskRow . '"> &#9998;  </a> ';
                echo '<td class="status verticalTop" style="text-align:right">' . $editTaskString . $htmlstring . $checkMark . ' </td>';
             }
             else
             {
                $htmlstring = '<input type="checkbox" class="status verticalTop" onclick="completeTask(this);" id="task' . $taskRow . '/index' . $index .'">';
                echo '<td class="status verticalTop" style="text-align:right">' . $htmlstring . $checkMark . ' </td>';
             }
          }

          if(!empty($task['title']) && strlen($task['title']) > 26)
            echo '<td><div class = "taskDiv">' . $task['title'] . '</div> </td>';
          else
            echo '<td><div class = "taskDivNotFilled">' . $task['title'] . '</div></td>';

          if($task['expiring'] - time() <= 259200 && $task['completed'] == "false"):
            echo '<td class="expDate closeDate verticalTop"> <b>' . $data . '</b> </td>';
          else:
            echo '<td class="expDate verticalTop"> <b>' . $data . '</b> </td>';
          endif;

          if(!empty($task['description']) && strlen($task['description']) > 26)
            echo '<td><div class = "descriptionDiv">' . $task['description'] . '</div> </td>';
          else
            echo '<td><div class = "descriptionDivNotFilled">' . $task['description'] . '</div></td>';

          if ($lists[$index]['userID'] != $_SESSION['user_id'])
          {
            echo '</tr>';
          }
          else
          {
            echo' <td class="delete verticalTop">
                  <a class = "buttonCursor" onclick="deleteTask(this);" id="task' . $taskRow . '/"> X </a>
                  </td>
                </tr>';
          }
        }
      }
      else
        $taskRow = null;
      ?>
</tbody>
</table>
</div>
<br>
  <div style="overflow-x:auto;" class = "<?= $toHide ?>">
    <form id="addTaskForm" action="../task_management/addTask.php" method="POST" onSubmit = "return input()" >
      <input type="text" id="taskNameid" class = "verticalTop" name="taskName" placeholder="task name" required>
      <input id = "idList2" type="hidden" name = "listID" value = "<?= $lists[$index]['id'] ?>">
      <input id = "taskExpDateInput" class = "verticalTop" type="text" name="taskDate" placeholder="(dd-mm-yyyy)">
      <textarea id= "descriptionBox" rows ="5" name="taskDescription" placeholder = "description (optional)"></textarea> <br>
      <input class = "buttonCursor verticalTop" id="addTaskID" type="submit" name = "addTaskButton" value="Add task"> <br>
      <input id="addTaskAuthToken" type="hidden" name="AuthToken">
      <input id="addTaskFormID" type="hidden" value="addTaskForm" name="tokenName">
    </form>
  </div>
<br>
<div class = "<?= $toHide; ?>">
<form class = " form " action = "../list_management/deleteList.php" method="POST">
  <input class = "buttonCursor" type="submit" name = "deleteListButton" value="Delete list">
  <input id = "idList3" type="hidden"  name = "listID" value = "<?= $lists[$index]['id'] ?>">
  <input id="delListAuthToken" type="hidden" name="AuthToken">
  <input id="delListID" type="hidden" value="delListForm" name="tokenName">
</form>
  <form id="userInviteForm" class = "form" action="../list_management/inviteUsers.php" method="POST">
    <input type="text" id="usernameInput" name="user" placeholder="Search users">
    <input id = "idListName" type="hidden" name = "listName" value = "<?= $lists[$index]['name'] ?>">
    <input id = "idList4" type="hidden"  name = "listID" value = "<?= $lists[$index]['id'] ?>">
    <input class = "buttonCursor" type = "submit" value = "Invite">
    <input id ="inviteUserAuthToken" type="hidden" name="AuthToken">
    <input id="inviteUserID" type="hidden" value="inviteUserForm" name="tokenName">
  </form>
</div>

<form id = "editTaskForm" class = "id" action="../task_management/editTask.php" method = "POST">
    <input type="hidden" id ="editTaskID" name ="taskID">
    <input type="hidden" id="editTaskAuthToken" name="AuthToken">
    <input type="hidden" id="editTaskTokenName" name="tokenName" value="editTaskForm">
</form>

<input type="hidden" id="ReqAuthToken" value=<?=$_SESSION['AuthRequestToken']?>>
<script src='../list_management/frontpage.js'> </script>
<script src='../task_management/completeTask.js'> </script>

</section>
      <?php else: ?>
        <div id="welcome">
            <p>Do it <br>
            Just do it<br>

            Don't let your dreams be dreams<br>
            Yesterday you said tomorrow<br>
            So just do it<br>
            Make your dreams come true<br>
            Just do it<br>

            Some people dream of success<br>
            While you're gonna wake up and work hard at it<br>
            Nothing is impossible<br>

            You should get to the point<br>
            Where anyone else would quit<br>
            And you're not going to stop there<br>
            No, what are you waiting for?<br>

            Do it<br>
            Just do it<br>
            Yes you can<br>
            Just do it<br>
            If you're tired of starting over<br>
            Stop giving up <br> <br>
          - Shia LaBeouf</p>
        </div>
      <?php endif; ?>
