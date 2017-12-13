function input() {
    inputDate = document.getElementById("taskExpDateInput").value;

    var verifyDateFormat = /^(\d{1,2})-(\d{1,2})-(\d{4})$/;
    var validDateValue = /(^(((0[1-9]|1[0-9]|2[0-8])[-](0[1-9]|1[012]))|((29|30|31)[-](0[13578]|1[02]))|((29|30)[-](0[4,6,9]|11)))[-](19|[2-9][0-9])\d\d$)|(^29[-]02[-](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)/;
    var validYear = /(^(\d{1,2})-(\d{1,2})-(19[789]\d|20[01]\d)$)/;

    if (!inputDate.match(verifyDateFormat)) {
        document.getElementById("message").innerHTML = "Please enter a dd-mm-yyyy date";
        document.getElementById("message").classList.remove('hidden');
        document.getElementById("message").classList.add('error');
        return false;
    } else if (!inputDate.match(validDateValue)) {
        document.getElementById("message").innerHTML = "Please enter a valid date";
        document.getElementById("message").classList.remove('hidden');
        document.getElementById("message").classList.add('error');
        return false;
    } else if (!inputDate.match(validYear)) {
        document.getElementById("message").innerHTML = "Year must be at least 1970";
        document.getElementById("message").classList.remove('hidden');
        document.getElementById("message").classList.add('error');
        return false;
    } else
        return true;

    return false;
}

function editList(list) {
    let editform = document.getElementById("editListForm");

    document.getElementById("editListID").value = list.id.substr(4);
    editform.submit();
}

function RequestAuthToken(tokenName, elementToChange, isHtml = true) {
    let token = this.document.getElementById("ReqAuthToken");

    if (token == null) {
        console.log("Failed to find auth token");
        return;
    }

    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if (this.responseText != -1) {
                if (isHtml) {
                    elementToChange.value = this.responseText;
                } else {
                    elementToChange.val = this.responseText;
                }
            } else if (this.responseText == -2) {
                console.log("[ERROR]\tAuth Token Not Sent");
            } else if (this.responseText == -3) {
                console.log("[ERROR]\tFailed to validate Auth Token");
            }
        }
    };

    xhttp.open("POST", "../main/requestsToken.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("&tokenName=" + tokenName + "&AuthToken=" + token.value);
}


var deleteTaskAJAXAuthToken = {
    val: 0
};

var deleteTaskAJAXTokenName = "deleteTaskAJAX";
var getListToScriptAJAXAuthToken = {
    val: 0
};

var getListToScriptAJAXTokenName = "getListToScriptAJAX";
var getListDataAJAXAuthToken = {
    val: 0
};

var getListDataAJAXTokenName = "getListDataAJAX";
var getListIndexAJAXAuthToken = {
    val: 0
};

var getListIndexAJAXTokenName = "getListIndexAJAX";

window.onload = function(e) {
    RequestAuthToken(deleteTaskAJAXTokenName, deleteTaskAJAXAuthToken, false);
    RequestAuthToken(getListToScriptAJAXTokenName, getListToScriptAJAXAuthToken, false);
    RequestAuthToken(getListDataAJAXTokenName, getListDataAJAXAuthToken, false);
    RequestAuthToken(getListIndexAJAXTokenName, getListIndexAJAXAuthToken, false);

    let searchToken = document.getElementById("searchAuthToken");
    if (searchToken != null) {
        let id = document.getElementById("searchID");
        console.log(id.value);
        RequestAuthToken(id.value, searchToken);
    }

    let addListToken = document.getElementById("addListAuthToken");
    if (addListToken != null) {
        let id = document.getElementById("addListID");
        console.log(id.value);
        RequestAuthToken(id.value, addListToken);
    }

    let editListToken = document.getElementById("editListAuthToken");
    if (editListToken != null) {
        let id = document.getElementById("editListFormID");
        console.log(id.value);
        RequestAuthToken(id.value, editListToken);
    }

    let addTaskToken = document.getElementById("addTaskAuthToken");
    if (addTaskToken != null) {
        let id = document.getElementById("addTaskID");
        console.log(id.value);
        RequestAuthToken(id.value, addTaskToken);
    }

    let delListToken = document.getElementById("delListAuthToken");
    if (delListToken != null) {
        let id = document.getElementById("delListID");
        console.log(id.value);
        RequestAuthToken(id.value, delListToken);
    }

    let inviteUserToken = document.getElementById("inviteUserAuthToken");
    if (inviteUserToken != null) {
        let id = document.getElementById("inviteUserID");
        console.log(id.value);
        RequestAuthToken(id.value, inviteUserToken);
    }

}

function XSS_Remove_Tags(string, elementToChange) {
    var val = string;

    elementToChange.value = val.replace(/<\/?[^>]+(>|$)/g, "");
}

var searchForm = document.querySelector("#searchForm");
if (searchForm != null) {
    var searchInput = searchForm.querySelector("#searchImp");

    if (searchInput != null) {
        searchInput.oninput = function() {
            let str = searchInput.value;
            str = XSS_Remove_Tags(str, searchInput);
        }
    }
}


var listTable = document.querySelector("#listsTable");
var currList = 0;

function deleteTask(task) {
    if (confirm("Are you sure you want to delete this task?") == true) {
        var taskID = (task.id.substr(0, task.id.indexOf('/'))).substr(4);
        var xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == 0) {
                    location.reload();
                }
            }
        };

        xhttp.open("POST", "../task_management/deleteTask.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("&task_id=" + taskID + "&tokenName=" + deleteTaskAJAXTokenName + "&AuthToken=" + deleteTaskAJAXAuthToken.val);
    }
}

function editTask(task) {
    let editform = document.getElementById("editTaskForm");

    document.getElementById("editTaskID").value = task.id.substr(4);
    editform.submit();
}

var tasklist = [];

if (listTable != null) {
    var listOwnerArray = [];
    var xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            listOwnerArray = JSON.parse(this.responseText);
        }
    };

    xhttp.open("POST", "../list_management/getListToScript.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("&tokenName=" + getListToScriptAJAXTokenName + "&AuthToken=" + getListToScriptAJAXAuthToken.val);

    let listName = document.getElementById("taskNameid");
    if (taskExpDateInput != null) {
        listName.oninput = function() {
            let str = listName.value;
            str = XSS_Remove_Tags(str, listName);
        };
    }

    let descBox = document.getElementById("descriptionBox");
    if (descBox != null) {
        descBox.oninput = function() {
            let str = descBox.value;
            str = XSS_Remove_Tags(str, descBox);
        }
    }

    let dateBox = document.getElementById("taskExpDateInput");
    if (dateBox != null) {
        dateBox.oninput = function() {
            let str = dateBox.value;
            str = XSS_Remove_Tags(str, dateBox);
        }
    }

    let listtableform = document.getElementById("addListForm");
    let formInput = listtableform.querySelector("#listnameID");
    formInput.oninput = function() {
        let str = formInput.value;
        str = XSS_Remove_Tags(str, formInput);
    }

    listTable.onclick = function(ev) {
        if (ev.target.parentElement.querySelector('.id') != null) {
            var clickedID = ev.target.parentElement.querySelector('.id').innerText;
            var clickedName = ev.target.parentElement.querySelector('.name').innerText;

            document.getElementById('idList2').value = clickedID;
            document.getElementById('idList3').value = clickedID;
            document.getElementById('idList4').value = clickedID;
            document.getElementById('idListName').value = clickedName;

            var clickedName = ev.target.parentElement.querySelector('.name').innerText;
            document.getElementById('ListName').innerHTML = clickedName;

            var index = ev.target.parentElement.rowIndex;
            if (index == null) {
                console.log("NULL row");
            } else {
                currList = index;

                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if (this.responseText == -1 || this.responseText == -2 || this.responseText == -3) {
                            document.getElementById("message").innerHTML = "Error";
                            document.getElementById("message").classList.remove('hidden');
                        } else {
                            var tasks = JSON.parse(this.responseText);
                            for (let i = 0; i < tasks.length; ++i) {
                                tasklist.push(JSON.parse(tasks[i]));
                            }
                        }
                    }
                    let tableHTML = document.querySelector("#taskTable").querySelector("tbody");
                    var htmlString = '';

                    if (tasklist.length != 0) {
                        htmlString = `<tr>
                           <th class="id">ID</th>
                           <th class="status arrowCursor" ></th>
                           <th class="task arrowCursor">Task</th>
                           <th class="expDate arrowCursor">Expiration Date </th>
                           <th id="descriptionHead" class="task arrowCursor">Description </th>
                           <th class="deltete task"></th>
                         </tr>`;
                        for (let i = 0; i < tasklist.length; ++i) {
                            var taskRow = tasklist[i].id;

                            htmlString = htmlString + "\n" + "<tr>";
                            htmlString = htmlString + "\n" + '<td class="id verticalTop">' + tasklist[i].id + '</td>';

                            if (tasklist[i].completed == "true") {
                                var checkMark = "&#10004;";
                                var htmlstring = '';
                                var editTaskString = '';

                                htmlString = htmlString + "\n" + '<td class="status verticalTop" >' +
                                    editTaskString + htmlstring + checkMark + ' </td>';

                            } else {
                                var checkMark = "";
                                if (listOwnerArray[index].userID !== listOwnerArray.slice(-1).pop()) {
                                    var htmlstring = '<input type="checkbox" class="status verticalTop" onclick="completeTask(this);" id="task' + taskRow + '/index' + currList + '"';

                                    htmlString = htmlString + "\n" + '<td class="status verticalTop" style="text-align:right;" >' + htmlstring + checkMark + ' </td>';
                                } else {
                                    let htmlstring = '<input style=" margin-left: -13px" onclick="completeTask(this);" id="task' + taskRow + '/index' + currList + '" type="checkbox"';
                                    let editTaskString = '<a class = "buttonCursor left_align" onclick="editTask(this);" id="task' + taskRow + '"> &#9998;  </a> ';

                                    htmlString = htmlString + "\n" + '<td class="status verticalTop" style="text-align:right;" >' +
                                        editTaskString + htmlstring + checkMark + ' </td>';
                                }

                            }

                            if ((tasklist[i].title).length != 0 && (tasklist[i].title).length > 26)
                                htmlString = htmlString + "\n" + '<td id = "description"> <div class = "taskDiv">' + tasklist[i].title + ' </div></td>';
                            else
                                htmlString = htmlString + "\n" + '<td id = "description"><div class = "taskDivNotFilled">' + tasklist[i].title + '</div></td>';

                            let data = "";

                            if (tasklist[i].expiring != null) {
                                data = tasklist[i].expiring;
                            }

                            let taskDate = new Date(data * 1000);
                            let taskDateYear = taskDate.getYear();
                            let taskDateMonth = taskDate.getMonth() + 1;
                            let taskDateDay = taskDate.getDate() + 1;

                            function pad(n) {
                                return (n < 10) ? ("0" + n) : n;
                            }

                            let currentDate = new Date();
                            let currentDay = currentDate.getDate() + 1;
                            let currentMonth = currentDate.getMonth() + 1;
                            let currentYear = currentDate.getYear();

                            let diffData = (currentDate.getTime() - (taskDate.getTime()));
                            let diffDay = pad(taskDateDay, 2) - pad(currentDay, 2);
                            let diffMonth = pad(taskDateMonth, 2) - pad(currentMonth, 2);
                            let diffYear = pad(taskDateYear, 2) - pad(currentYear, 2);

                            if (((diffYear < 0 || diffMonth < 0) || (diffYear == 0 && diffMonth == 0 && diffDay <= 3)) && tasklist[i].completed != "true")
                                htmlString = htmlString + "\n" + '<td class="expDate closeDate verticalTop"><b>' + pad(taskDateDay, 2) + "-" + pad(taskDateMonth, 2) + "-" + taskDate.getFullYear() + '</td>';
                            else
                                htmlString = htmlString + "\n" + '<td class="expDate verticalTop"><b>' + pad(taskDateDay, 2) + "-" + pad(taskDateMonth, 2) + "-" + taskDate.getFullYear() + '</td>';

                            if ((tasklist[i].description).length != 0 && (tasklist[i].description).length > 26)
                                htmlString = htmlString + "\n" + '<td id = "description"> <div class = "descriptionDiv">' + tasklist[i].description + ' </div></td>';
                            else
                                htmlString = htmlString + "\n" + '<td id = "description"><div class = "descriptionDivNotFilled">' + tasklist[i].description + '</div></td>';

                            if (listOwnerArray[index].userID !== listOwnerArray.slice(-1).pop()) {
                                htmlString = htmlString + "\n" + '<td class="delete verticalTop"> </td></tr>';
                            } else {
                                htmlString = htmlString + "\n" +  `<td class="delete verticalTop">
                                                                     <a class = "buttonCursor" onclick="deleteTask(this);" id="task` + taskRow + `/"> X </a>
                                                                   </td>
                                                                   </tr>`;
                            }
                        }
                    };

                    tableHTML.innerHTML = htmlString;
                    tasklist.length = 0;
                }
            };

            xhttp.open("POST", "../list_management/getListData.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("index=" + currList + "&tokenName=" + getListDataAJAXTokenName + "&AuthToken=" + getListDataAJAXAuthToken.val);

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText == 0) {
                        document.getElementById("message").innerHTML = "Completed Task";
                        document.getElementById("message").classList.remove('hidden');
                    }
                }
            };

            xhttp.open("POST", "../list_management/getListIndex.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("listID=" + clickedID + "&tokenName=" + getListIndexAJAXTokenName + "&AuthToken=" + getListIndexAJAXAuthToken.val);
        }
    }
}

var inviteUserForm = document.querySelector("#userInviteForm");
var userNameInput = inviteUserForm.querySelector("#usernameInput");

userNameInput.oninput = function() {
    let str = userNameInput.value;
    str = XSS_Remove_Tags(str, userNameInput);
}
