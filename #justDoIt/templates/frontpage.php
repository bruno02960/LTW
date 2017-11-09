<?php if(isset($user)): ?>
  <nav id="menu">
    <ul>
      <li><a href="index.html">Completed</a></li>
      <li><a href="index.html">To Complete</a></li>
      <li><a href="index.html">Expiring</a></li>
    </ul>
  </nav>
    <p id = "message" class = "hidden"> </p>
    <section id="list">
  <h1> Selected list name </h1>
  <table class="tasks" id="taskTable">
  <tr>
    <th class="status">Status</th>
    <th class="task">Task</th>
  </tr>
  <tr>
    <td class="status">incomplete</td>
    <td class="task">ABCDEFGHIJKLMNOPQRSTUVWXYZ</td>
  </tr>
  <tr>
    <td class="status">complete</td>
    <td class="task">ABCDEFGHIJKLMNOPQRSTUVWXYZ</td>
  </tr>
  <tr>
    <td class="status">incomplete</td>
    <td class="task">ABCDEFGHIJKLMNOPQRSTUVWXYZ</td>
  </tr>
  <tr>
    <td class="status">complete</td>
    <td class="task">ABCDEFGHIJKLMNOPQRSTUVWXYZ</td>
  </tr>
  <tr>
    <td class="status">incomplete</td>
    <td class="task">ABCDEFGHIJKLMNOPQRSTUVWXYZ</td>
  </tr>
  <tr>
    <td class="status">complete</td>
    <td class="task">ABCDEFGHIJKLMNOPQRSTUVWXYZ</td>
  </tr>
</table>
 <button id = "addTask" type = "button"> + </button>
 <input id = "newTask" type="text" name="newTask" placeholder="New task name"><br>
 <br>
<br>
<button id = "deleteListButton" type = "button"> Delete list </button>
</section>
<aside id="lists">
<h1> To-do lists </h1>
<table class="lists">
<tr>
<td class="list">Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</td>
</tr>
<tr>
<td class="list">Aliquam tincidunt mauris eu risus.</td>
</tr>
<tr>
<td class="list">Vestibulum auctor dapibus neque.</td>
</tr>
<tr>
<td class="list">Nunc dignissim risus id metus.</td>
</tr>
<tr>
<td class="list">Cras ornare tristique elit.</td>
</tr>
<tr>
<td class="list">Vivamus vestibulum nulla nec ante.</td>
</tr>
</table>
 <button id = "addList" type = "button"> + </button>

    <script>
      document.querySelector('#taskTable').onclick = function(ev) 
      {
        // ev.target <== td element
        // ev.target.parentElement <== tr
        var index = ev.target.parentElement.rowIndex;
        var table = document.getElementById("taskTable");
        items = table.getElementsByClassName("status");
        if(items[index].innerHTML == "incomplete") 
          {
            items[index].innerHTML = "complete";

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
