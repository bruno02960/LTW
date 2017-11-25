<?php if(isset($user)): ?>
  <nav id="menu">
     <ul>
        <li><a href="index.php">Completed</a></li>
        <li><a href="index.php">To Complete</a></li>
        <li><a href="index.php">Expiring</a></li>
     </ul>
  </nav>
  <p id = "message" class = "hidden"> </p>
  <aside id="lists">
     <h1> To-do lists </h1>
     <table class="lists" id="listsTable">
        <?php
           if($lists!=NULL)
           {
             foreach( $lists as $list)
             {
               echo '<tr>
                     <td class="id">' . $list['id']. '</td>
                     <td class="name">' . $list['name']. '</td>
                     </tr>';
             }
           }
           ?>
        <td class="list">
           <form action = "addList.php" method="POST">
              <input type="text" name="listName" placeholder="list name"><br>
              <input type="submit" name = "addListButton" value="Add list">
              <input id = "idList1" type="hidden"  name = "listID" value = "<?= $lists[$index]['id'] ?>">
           </form>
        </td>
        </tr>
     </table>
  </aside>
  <?php
     if($_SESSION['allLists'] == null)
     {
       $toHide = "hidden";
     }
     else
       $toHide = " ";
     ?>
  <section id="list">
     <h1 id = "ListName" class = "<?= $toHide ?>"> <?= $lists[$index]['name']?> </h1>
     <table class="tasks <?= $toHide ?>" id="taskTable">
        <tbody>
           <tr>
              <th class="id">ID</th>
              <th class="status">Status</th>
              <th class="task">Task</th>
              <th class="expDate">Expiration Date </th>
           </tr>
           <?php
              if($tasks!=NULL)
              {
                foreach( $tasks as $task)
                {
                  $data = "";
                  if($task['expiring']!=NULL)
                  {
                    $data = date('m/d/Y', $task['expiring']);
                  }

              if($task['completed'] == "true")
              $checkMark = '&#10003;';
              else
              $checkMark = '&#10008;';

                  echo '<tr>
                          <td class="id">' . $task['id']. '</td>
                          <td class="status">' . $checkMark. '</td>
                          <td class="task">' . $task['title']. '</td>
                          <td class="expDate">' . $data .'</td>
                        </tr>';
                }
              }
              ?>
        </tbody>
        <tfooter>
           <tr class = "<?= $toHide ?>">
              <form action="addTask.php" method="POST">
                 <td><input type="submit" name = "addTaskButton" value="Add task"></td>
                 <td class="task"><input type="text" name="taskName" placeholder="task name"> </td>
                 <input id = "idList2" type="hidden" name = "listID" value = "<?= $lists[$index]['id'] ?>">
                 <td class="task"><input type="text" name="taskDate" placeholder="(mm/dd/yyyy)"></td>
              </form>
           </tr>
        </tfooter>
     </table>
     <br>
     <br>
     <form class = "<?= $toHide ?>" action = "deleteList.php" method="POST">
        <input type="submit" name = "deleteListButton" value="Delete list">
        <input id = "idList3" type="hidden"  name = "listID" value = "<?= $lists[$index]['id'] ?>">
     </form>
     <script src="frontpage.js"> </script>
  </section>
<?php else: ?>
  <section id="welcome">
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
        - Shia LaBeouf
     </p>
  </section>
<?php endif; ?>
</section>
