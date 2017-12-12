<section id="editTask">
  <p id = "message"> </p>
  <h2> Edit Task </h2>

  <div style="overflow-x:auto;">
  <table class="tasks" id="taskTable">
  <tbody class = "verticalTop">
    <tr>
      <th class="id">ID</th>
      <th class="status arrowCursor">Status</th>
      <th class="task arrowCursor">Task </th>
      <th class="expDate arrowCursor">Expiration Date </th>
      <th id="descriptionHead" class="task arrowCursor">Description </th>
    </tr>

    <?php
      if($task != null)
      {
        $row = 0;
          $data = "";
          $diffData = 0;
          if($task['expiring']!=NULL)
          {
            $data = date('d-m-Y', $task['expiring']);
            $diffData = time() - $task['expiring'];
          }

          if($task['completed'] == "true")
              $htmlstring = "&#10004";
          else
          {
            $htmlstring = '<input onkeypress="return keyListener(event)" id="statusCheck" type="checkbox">';
          }

          echo '<tr>
                  <td class="id">' . $task['id']. '</td>
                  <td class="status">' . $htmlstring . ' </td>
                  <td class="expDate" ><input type="text" onkeypress="return keyListener(event)" id = "titleTable" value="' . $task['title']. '"> </td>';


        if($diffData > 0 && $task['completed'] != "true"):
          echo '<td class="expDate"><input onkeypress="return keyListener(event)" type="text" id = "expDateTable" value="' . $data . '"> </td>';
        else:
          echo '<td class="expDate"><input onkeypress="return keyListener(event)" type="text" id = "expDateTable" value="' . $data . '"> </td>';
        endif;

          echo '<td class="buttonCursor"><textarea onkeypress="return keyListener(event)" id="taskDescriptionTable" name="taskDescriptionTable" rows="5">' . $task['description'] . '</textarea>
          <input type="hidden" id="completedText"  value="' . $task['completed'] . '"></td></tr>';
      }
    ?>
  </tbody>
  </table>
</div>
<div style = "display:inline;">
      <form id = "editorForm">
          <button id = "editTaskSubmit" type = "button"> Submit </button> <br>
          <input type="hidden" id = "editTaskID" name = "taskID" value="<?= $task['id']?>">
          <input id = "sendForm" type = "submit" class = "hidden"> <br>
      </form>

      <button type ="submit" onclick = "window.location='../main';"> Go Back </button> <br> <br>
</div>
</section>

<script>
    var submitButton = document.getElementById("editTaskSubmit");
    var form = document.getElementById("editorForm");
    var statusButton = document.getElementById('statusCheck');
    var statusCheck = document.getElementById('completedText').value;

    statusButton.addEventListener("click", function(event)
    {
        if(document.getElementById("completedText").value == "true")
        {
            event.preventDefault();
        }
        else
           { statusCheck = "true";
           }
    })

    function keyListener(e)
    {
        if (e.keyCode == 13)
        {
            submitButton.click();
            return false;
        }
    }



    submitButton.addEventListener("click", function(event)
    {
        event.preventDefault();
        document.getElementById("message").classList.value = '';
        document.getElementById("message").classList.add('hidden');

        var taskID = document.getElementById('editTaskID').value;
        var taskTitle = document.getElementById('titleTable').value;
        var taskExpDate = document.getElementById('expDateTable').value;
        
        var verifyDateFormat = /^(\d{1,2})-(\d{1,2})-(\d{4})$/;
        var validDateValue = /(^(((0[1-9]|1[0-9]|2[0-8])[-](0[1-9]|1[012]))|((29|30|31)[-](0[13578]|1[02]))|((29|30)[-](0[4,6,9]|11)))[-](19|[2-9][0-9])\d\d$)|(^29[-]02[-](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)/;
        var validYear = /(^(\d{1,2})-(\d{1,2})-(19[789]\d|20[01]\d)$)/;
        if (!taskExpDate.match(verifyDateFormat)) 
        {
        document.getElementById("message").innerHTML = "Please enter a dd-mm-yyyy date";
        document.getElementById("message").classList.remove('hidden');
        document.getElementById("message").classList.add('error');
        return false;
        }
        else if(!taskExpDate.match(validDateValue))
        {
        document.getElementById("message").innerHTML = "Please enter a valid date";
        document.getElementById("message").classList.remove('hidden');
        document.getElementById("message").classList.add('error');
        return false;
        }
        else if(!taskExpDate.match(validYear))
        {
        document.getElementById("message").innerHTML = "Year must be at least 1970";
        document.getElementById("message").classList.remove('hidden');
        document.getElementById("message").classList.add('error');
        return false;
        }

        var taskDescription = document.getElementById('taskDescriptionTable').value;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function()
        {
            if (this.readyState == 4 && this.status == 200)
            {
                if(this.responseText == 0)
                {
                    window.location.href = "../main/index.php";
                    return;
                }

                if(this.responseText == -2)
                {
                    var message = "Invalid day";
                    document.getElementById("message").innerHTML = message;
                    document.getElementById("message").classList.remove('success');
                    document.getElementById("message").classList.add('error');
                    document.getElementById("message").classList.remove('hidden');
                    return;
                }

                if(this.responseText == -3)
                {
                    var message = "Invalid month";
                    document.getElementById("message").innerHTML = message;
                    document.getElementById("message").classList.remove('success');
                    document.getElementById("message").classList.add('error');
                    document.getElementById("message").classList.remove('hidden');
                    return;
                }

                else
                {
                    var message = "Error";
                    document.getElementById("message").innerHTML = message;
                    document.getElementById("message").classList.remove('success');
                    document.getElementById("message").classList.add('error');
                    document.getElementById("message").classList.remove('hidden');
                    return;
                }
            }
        }
        xhttp.open("POST", "../task_management/checkTaskValidity.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("taskID=" + taskID + "&taskTitle=" + taskTitle + "&taskExpDate=" + taskExpDate + "&taskDescription=" + taskDescription +"&status=" + statusCheck);
    });
</script>
