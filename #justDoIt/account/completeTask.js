function completeTask(task)
{
  var statusButton = document.getElementById(task.id);
    if (confirm("Mark this task as completed?") == true)
    {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function()
      {
        if (this.readyState == 4 && this.status == 200)
        {
          if(this.responseText != 0)
          {
            var message = "Error";
            document.getElementById("message").innerHTML = message;
            document.getElementById("message").classList.add('error');
            document.getElementById("message").classList.remove('hidden');
          }
          else
          {
            var checkMark = "&#10004";
            var htmlstring = '';

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function()
            {
            if (this.readyState == 4 && this.status == 200)
            {
                if(this.responseText == -1 || this.responseText == -2 || this.responseText == -3)
                {
                document.getElementById("message").innerHTML = "Unexpected Error";
                document.getElementById("message").classList.remove('hidden');
                document.getElementById("message").classList.remove('error');
                }else{
                    location.reload();
                }
            }
          }

    var listIndex = (task.id.substr(task.id.indexOf('/'))).substr(6);
   

    xhttp.open("POST", "../main/getListData.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("index=" + listIndex);
        }
      }
    }
      var taskID = (task.id.substr(0,task.id.indexOf('/'))).substr(4);

      xhttp.open("POST", "../account/changeTaskBool.php", true);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send("completed=" + true + "&task_id=" + taskID);
    }
    else
      statusButton.checked = false;
}
