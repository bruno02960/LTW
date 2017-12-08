var currList = 0;
var tasklist = [];
var listTable = document.querySelector("#listsTable");

if(listTable!=null)
{
  listTable.onclick = function(ev)
  {
    if(ev.target.parentElement.querySelector('.id')!=null)
    {
    var clickedID = ev.target.parentElement.querySelector('.id').innerText;
    document.getElementById('idList1').value = clickedID;
    document.getElementById('idList2').value = clickedID;
    document.getElementById('idList3').value = clickedID;

    var clickedName = ev.target.parentElement.querySelector('.name').innerText;
    document.getElementById('ListName').innerHTML = clickedName;
    console.log(document.getElementById('ListName').value);

    var index = ev.target.parentElement.rowIndex;
    if(index==null)
    {
      console.log("NULL row");
    }
    else
    {
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
          }
          else
          {
              var tasks = JSON.parse(this.responseText);

              for(let i=0;i<tasks.length;++i)
              {
                tasklist.push(JSON.parse(tasks[i]));
              }
          }
        }

          let tableHTML = document.querySelector("#taskTable").querySelector("tbody");
          let htmlString = `<tr>
                              <th class="id">ID</th>
                              <th class="status">Status</th>
                              <th class="task">Task</th>
                              <th class="expDate">Expiration Date </th>
                            </tr>`;

          if(tasklist.length!=0)
          {
            for(let i=0;i<tasklist.length;++i)
            {
              if (tasklist[i].completed == "true")
                $checkMark = '&#10003;';
              else
                $checkMark = '&#10008;';

                      htmlString = htmlString + "\n" + "<tr>";
                      htmlString = htmlString + "\n" + '<td class="id">' + tasklist[i].id + '</td>';
                      htmlString = htmlString + "\n" + '<td class="status">' +  $checkMark +'</td>';
                      htmlString = htmlString + "\n" + '<td class="task">' +  tasklist[i].title + '</td>';

                      let data = ""

                      if(tasklist[i].expiring!=null)
                      {
                        data = tasklist[i].expiring;
                      }

                      var taskDate = new Date(data* 1000);
                      var taskDateMonth = taskDate.getMonth() + 1;
                      var taskDateDay = taskDate.getDate() + 1;

                      function pad(n)
                      {
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
        if (confirm("Mark this task as completed?") == true)
        {
          items[index].innerHTML = "\u2713";

          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function()
          {
            if (this.readyState == 4 && this.status == 200)
            {
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
