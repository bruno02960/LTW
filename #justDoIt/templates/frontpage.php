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
          $diffData = 0;
          if($task['expiring']!=NULL)
          {
            $data = date('m/d/Y', $task['expiring']);
            $diffData = time() - $task['expiring'];
          }

		  if($task['completed'] == "true")
			  $checkMark = '&#10003;';
		  else
			  $checkMark = '&#10008;';

          echo '<tr>
                  <td class="id">' . $task['id']. '</td>
                  <td class="status">' . $checkMark. '</td>
                  <td class="task">' . $task['title']. '</td>';
        if($diffData > 0 && $task['completed'] != "true"):
          echo '<td class="expDate"> <b>' . $data . '</b> </td>';
        else:
          echo '<td class="expDate">' . $data . ' </td>';
        endif;
          echo'<td class="deleteTask"> <input type="submit" name = "deleteTask" value="X"> </td>
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

  <script>
    var currList = 0;
    var tasklist = [];
    var listTable = document.querySelector("#listsTable");
    if(listTable!=null){
      listTable.onclick = function(ev){
        if(ev.target.parentElement.querySelector('.id')!=null){
        var clickedID = ev.target.parentElement.querySelector('.id').innerText;
        document.getElementById('idList1').value = clickedID;
        document.getElementById('idList2').value = clickedID;
        document.getElementById('idList3').value = clickedID;

        var clickedName = ev.target.parentElement.querySelector('.name').innerText;
        document.getElementById('ListName').innerHTML = clickedName;
        console.log(document.getElementById('ListName').value);

        var index = ev.target.parentElement.rowIndex;
        if(index==null){
          console.log("NULL row");
        }else{
          currList = index;

          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function()
          {
            if (this.readyState == 4 && this.status == 200)
            {
              if(this.responseText == -1 || this.responseText == -2 || this.responseText == -3)
              {
                document.getElementById("message").innerHTML = "Error";
                document.getElementById("message").classList.remove('hidden');
              }else{
                  var tasks = JSON.parse(this.responseText);
                  for(let i=0;i<tasks.length;++i){
                    tasklist.push(JSON.parse(tasks[i]));
                  }
                }
              }
              let tableHTML = document.querySelector("#taskTable").querySelector("tbody");
              let htmlString = `
              <tr>
                <th class="id">ID</th>
                <th class="status">Status</th>
                <th class="task">Task</th>
                <th class="expDate">Expiration Date </th>
              </tr>`;
              if(tasklist.length!=0)
        {
                for(let i=0;i<tasklist.length;++i)
        {
          if(tasklist[i].completed == "true")
            var checkMark = '&#10003;';
          else
            var checkMark = '&#10008;';

                  htmlString = htmlString + "\n" + "<tr>";
                  htmlString = htmlString + "\n" + '<td class="id">' + tasklist[i].id + '</td>';
                  htmlString = htmlString + "\n" + '<td class="status">' +  checkMark +'</td>';
                  htmlString = htmlString + "\n" + '<td class="task">' +  tasklist[i].title + '</td>';
                  let data = ""
                  if(tasklist[i].expiring!=null){
                    data = tasklist[i].expiring;
                  }
                  var taskDate = new Date(data* 1000);
                  var taskDateMonth = taskDate.getMonth() + 1;
                  var taskDateDay = taskDate.getDate() + 1;
                  function pad(n) {
                      return (n < 10) ? ("0" + n) : n;
                  }
                  htmlString = htmlString + "\n" + '<td class="expDate">' +  pad(taskDateMonth,2) + "/" + pad(taskDateDay,2) + "/" + taskDate.getFullYear() +'</td>';
                  htmlString = htmlString + "\n" + "</tr>";
                }
              };

              tableHTML.innerHTML = htmlString;
              tasklist.length = 0;
            }
          };

          xhttp.open("POST", "../main/getListData.php", true);
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp.send("index=" + currList);

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

          xhttp.open("POST", "../main/getListIndex.php", true);
          xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xhttp.send("listID=" + clickedID);
          }
        }
      }

    var taskTable = document.querySelector('#taskTable');
    if(taskTable!=null)
    {
      document.querySelector('#taskTable').onclick = function(ev)
      {
        var index = ev.target.parentElement.rowIndex;
        var table = document.getElementById("taskTable");
        items = table.getElementsByClassName("status");
        if(items[index]!=null)
        {
          if(items[index].innerHTML == "\u2718")
          {
            if (confirm("Are you sure?") == true)
            {
              items[index].innerHTML = "\u2713";

              var xhttp = new XMLHttpRequest();
              xhttp.onreadystatechange = function()
              {
                if (this.readyState == 4 && this.status == 200)
                {
                  if(this.responseText == 0)
                    console.log("good");
                }
              };

              items = table.getElementsByClassName("id");

              xhttp.open("POST", "../account/changeTaskBool.php", true);
              xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
              xhttp.send("completed=" + true + "&task_id=" + items[index].innerHTML);
            }
          }
        }
      }
    }
  </script>

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
  - Shia LaBeouf</p>
  </section>
        <?php endif; ?>
      </section>
