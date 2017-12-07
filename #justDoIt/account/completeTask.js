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
          <th class="arrowCursor">Description </th>
        </tr>`;
           
        if(tasklist.length!=0)
        {
          for(let i=0;i<tasklist.length;++i)
        {
          let taskRow = task.id.substr(4);
          if(tasklist[i].completed == "true")
          { 
            var checkMark = "&#10004";
            var htmlstring = '';
          }
         else
          { 
            var checkMark = "";
            var htmlstring = '<input onclick="completeTask(this);" id="task' + taskRow + '" type="checkbox"';
          }

            

            htmlString = htmlString + "\n" + "<tr>";
            htmlString = htmlString + "\n" + '<td class="id verticalTop">' + tasklist[i].id + '</td>';

            htmlString = htmlString + "\n" + '<td class="status verticalTop">' + 
                          '<a class = "buttonCursor left_align" onclick="editTask(this);" id="task' + taskRow + '-index' + currList + '"> &#9998  </a> ' + htmlstring + checkMark + ' </td>';

            htmlString = htmlString + "\n" + '<td class="task verticalTop">' +  tasklist[i].title + '</td>';
            
            let data = ""
            if(tasklist[i].expiring!=null){
              data = tasklist[i].expiring;
            }
            let taskDate = new Date(data* 1000);
            let taskDateMonth = taskDate.getMonth() + 1;
            let taskDateDay = taskDate.getDate() + 1;
            function pad(n) {
                return (n < 10) ? ("0" + n) : n;
            }
            let currentDate = new Date();
            let diffData = (currentDate.getTime() - (taskDate.getTime()));

            if(diffData > 259200 && tasklist[i].completed != "true")
              htmlString = htmlString + "\n" + '<td class="expDate closeDate verticalTop"><b>' +  pad(taskDateMonth,2) + "/" + pad(taskDateDay,2) + "/" + taskDate.getFullYear() +'</td>';
            else
              htmlString = htmlString + "\n" + '<td class="expDate verticalTop"><b>' +  pad(taskDateMonth,2) + "/" + pad(taskDateDay,2) + "/" + taskDate.getFullYear() +'</td>';

            if((tasklist[i].description).length != 0 && (tasklist[i].description).length > 30)
              htmlString = htmlString + "\n" + '<td class="buttonCursor" id = "description"> <div id = "descriptionDiv">' + tasklist[i].description + '</div></td>';
            else
              htmlString = htmlString + "\n" + '<td class="buttonCursor" id = "description"><div id = "descriptionDivNotFilled">' + tasklist[i].description + '</div></td>';

            htmlString = htmlString + "\n" + '<td class="delete buttonCursor verticalTop">' + '<a onclick="deleteTask(this);" id="task' + taskRow + '">X</a> ' + '</td>';
            htmlString = htmlString + "\n" + "</tr>";
          }
        };

        tableHTML.innerHTML = htmlString;
        tasklist.length = 0;
      }
   
    var listIndex = task.id.split('/')[1].substr(5);

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
