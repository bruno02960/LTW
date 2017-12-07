<section id="editTask">

<p id = "message"> </p>

<h2> Edit Task </h2>

<table class="tasks <?= $toHide ?>" id="taskTable">
<tbody>
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
            $checkMark = "checked";
        else
            $checkMark = "";

        echo '
            
            <tr>
                <td class="id">' . $task['id']. '</td>
                <td class="status"> <input onkeypress="return keyListener(event)" id="statusCheck" type="checkbox" ' . $checkMark . '></td>
                <td class="expDate" ><input type="text" onkeypress="return keyListener(event)" id = "titleTable" value="' . $task['title']. '"> </td>';


      if($diffData > 0 && $task['completed'] != "true"):
        echo '<td class="expDate"><input onkeypress="return keyListener(event)" type="text" id = "expDateTable" value="' . $data . '"> </td>';
      else:
        echo '<td class="expDate"><input onkeypress="return keyListener(event)" type="text" id = "expDateTable" value="' . $data . '"> </td>';
      endif;

        echo '<td class="buttonCursor"><textarea onkeypress="return keyListener(event)" id="taskDescriptionTable" name="taskDescriptionTable" rows="5">' . $task['description'] . '</textarea></td>
        <input type="hidden" id="completedText"  value="' . $task['completed'] . '"></tr>';

    }
  ?>
</tbody>
</table>

    <form id = "editorForm">
        <button id = "editTaskSubmit" type = "button"> Submit </button> <br>
        <input type="hidden" id = "editTaskID" name = "taskID" value="<?= $task['id']?>">
        <input id = "sendForm" type = "submit" class = "hidden"> <br>
    </form>



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
        xhttp.open("POST", "../account/checkTaskValidity.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("taskID=" + taskID + "&taskTitle=" + taskTitle + "&taskExpDate=" + taskExpDate + "&taskDescription=" + taskDescription +"&status=" + statusCheck);
    });

</script>