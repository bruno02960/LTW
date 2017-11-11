<?php if(isset($user)): ?>
  <nav id="menu">
    <ul>
      <li><a href="index.php">Completed</a></li>
      <li><a href="index.php">To Complete</a></li>
      <li><a href="index.php">Expiring</a></li>
    </ul>
  </nav>
    <p id = "message" class = "hidden"> </p>
    <section id="list">
  <h1> Selected list name </h1>
  <table class="tasks" id="taskTable">
  <tr>
    <th class="status">Status</th>
    <th class="task">Task</th>
    <th class="expDate">Expiration Date </th>
  </tr>
  <?php
  if($tasks!=NULL) {
    foreach( $tasks as $task) {
      $data = "";
      if($task['expiring']!=NULL){
        $data = date('d/m/Y', $task['expiring']);
      }
      echo '<tr>
              <td class="status">' . $task['completed']. '</td>
              <td class="task">' . $task['title']. '</td>
              <td class="expDate">' . $data .'</td>
            </tr>';
    }
  }
    ?>
  <tr>
    <form action"index.php" method="post">
    <td><input type="submit" name = "addTaskButton" value="Add task"></td>
    <td class="task"><input type="text" name="taskName" placeholder="task name">
    <td class="task"><input type="text" name="taskDate" placeholder="expiring (mm/dd/yyyy)"></td>
      </form>
  </tr>
</table>
 <br>
<br>
<form action"index.php" method="post">
<input type="submit" name = "deleteListButton" value="Delete list">
</form>
</section>
<aside id="lists">
<h1> To-do lists </h1>
<table class="lists" id="listsTable">
  <?php
  if($lists!=NULL) {
    foreach( $lists as $list) {
      echo '<tr>
            <td class="list">' . $list['name']. '</td>
            </tr>';
    }
  }
    ?>
<td class="list"><form action"index.php" method="post">
  <input type="text" name="listName" placeholder="list name"><br>
  <input type="submit" name = "addListButton" value="Add list">
  </form></td>
</tr>
</table>

    <script>

      var addList = document.querySelector('#addList');
      if(addList!=null){ 
      document.querySelector('#addList').onclick = function(ev)
      {
          document.getElementById("message").innerHTML = "Added list";
          document.getElementById("message").classList.remove('hidden');
      }
      }

      var addTask = document.querySelector('#addTask');
      if(addTask!=null){ 
      document.querySelector('#addTask').onclick = function(ev)
      {

          document.getElementById("message").innerHTML = "Added task";
          document.getElementById("message").classList.remove('hidden');
      }
      }

      var taskTable = document.querySelector('#taskTable');
      if(taskTable!=null){
      document.querySelector('#taskTable').onclick = function(ev)
      {
        // ev.target <== td element
        // ev.target.parentElement <== tr
        var index = ev.target.parentElement.rowIndex;
        var table = document.getElementById("taskTable");
        items = table.getElementsByClassName("status");
        if(items[index].innerHTML == "false")
          {
            items[index].innerHTML = "true";

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function()
            {
              if (this.readyState == 4 && this.status == 200)
              {
                if(this.responseText == 0)
                {
                  document.getElementById("message").innerHTML = "Completed Task";
                  document.getElementById("message").classList.remove('hidden');
                }
              }
            };

            xhttp.open("POST", "../account/changeTaskBool.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("completed=" + true + "&task_id=" + index);
          }
      }
      }
    </script>

</aside>
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
- Shia LaBeouf</p>
</section>
      <?php endif; ?>
    </section>
