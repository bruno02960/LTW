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
        let htmlString = `<tr>
                            <th class="id">ID</th>
                            <th class="status arrowCursor" ></th>
                            <th class="task arrowCursor">Task</th>
                            <th class="expDate arrowCursor">Expiration Date </th>
                            <th id="descriptionHead" class="task arrowCursor">Description </th>
                            <th class="deltete task"></th>
                          </tr>`;

        if(tasklist.length!=0)
        {
          for(let i=0;i<tasklist.length;++i)
        {
          let taskRow = (task.id.substr(0,task.id.indexOf('/'))).substr(4);

          htmlString = htmlString + "\n" + "<tr>";
          htmlString = htmlString + "\n" + '<td class="id verticalTop">' + tasklist[i].id + '</td>';

          if(tasklist[i].completed == "true")
          {
            var checkMark = "&#10004;";
            var htmlstring = '';
            var editTaskString='';

            htmlString = htmlString + "\n" + '<td class="status verticalTop" >' +
                          editTaskString + htmlstring + checkMark + ' </td>';

          }
          else
          {
            var checkMark = "";
            var htmlstring = '<input style=" margin-left: -13px" onclick="completeTask(this);" id="task' + taskRow + '/index' + currList  + '" type="checkbox"';
            var editTaskString='<a class = "buttonCursor left_align" onclick="editTask(this);" id="task' + taskRow + '"> &#9998;  </a> ';


            htmlString = htmlString + "\n" + '<td class="status verticalTop" style="text-align:right;" >' +
                          editTaskString + htmlstring + checkMark + ' </td>';
          }

          htmlString = htmlString + "\n" + '<td class="task verticalTop">' +  tasklist[i].title + '</td>';

            let data = ""
            if(tasklist[i].expiring!=null){
              data = tasklist[i].expiring;
            }
            let taskDate = new Date(data* 1000);
            let taskDateYear = taskDate.getYear();
            let taskDateMonth = taskDate.getMonth() + 1;
            let taskDateDay = taskDate.getDate() + 1;

            function pad(n)
            {
                return (n < 10) ? ("0" + n) : n;
            }

            let currentDate = new Date();
            let currentDay = currentDate.getDate() + 1;
            let currentMonth = currentDate.getMonth() + 1;
            let currentYear = currentDate.getYear();
            
            //let diffData = (currentDate.getTime() - (taskDate.getTime()));
            let diffDay = pad(taskDateDay,2) - pad(currentDay,2);
            let diffMonth = pad(taskDateMonth,2) - pad(currentMonth,2);
            let diffYear = pad(taskDateYear,2) - pad(currentYear,2);
            
            if(((diffYear < 0 || diffMonth < 0) || (diffYear == 0 && diffMonth == 0 && diffDay < 3)) && tasklist[i].completed != "true")
              htmlString = htmlString + "\n" + '<td class="expDate closeDate verticalTop"><b>' + pad(taskDateDay,2) + "-" + pad(taskDateMonth,2) + "-"  + taskDate.getFullYear() +'</td>';
            else
              htmlString = htmlString + "\n" + '<td class="expDate verticalTop"><b>' + pad(taskDateDay,2) + "-" +  pad(taskDateMonth,2) + "-" + taskDate.getFullYear() +'</td>';

              if((tasklist[i].description).length != 0 && (tasklist[i].description).length > 30)
              htmlString = htmlString + "\n" + '<td class="buttonCursor" id = "description"> <div class = "descriptionDiv">' + tasklist[i].description + ' </div></td>';
            else
              htmlString = htmlString + "\n" + '<td class="buttonCursor" id = "description"><div class = "descriptionDivNotFilled">' + tasklist[i].description + '</div></td>';

              clickedName = task.id.split('-')[1].substr(4);

              if (clickedName.indexOf('-') > -1)
              {
                htmlString = htmlString +  '</tr>';
              }
              else
              {
                htmlString = htmlString +
                "\n" +
                `<td class="delete verticalTop">
                  <a class = "buttonCursor" onclick="deleteTask(this);" id="task` + taskRow + `/"> X </a>
                </td>`;
              }
          }
        };

        tableHTML.innerHTML = htmlString;
        tasklist.length = 0;
      }

    var listIndex = (task.id.substr(0,task.id.indexOf('-'))).substr(task.id.indexOf('/')).substr(6);
    console.log(listIndex);
   

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
