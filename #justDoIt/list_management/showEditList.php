<section id="editTask">
    <p id = "message"> </p>
    <h2> Edit List </h2>

    <div style="overflow-x:auto;">
        <table class="tasks" id="taskTable">
            <tbody class = "verticalTop">
                <tr>
                    <th class="id">ID</th>
                    <th style ="width: 183px;" class="task arrowCursor">List Name </th>
                </tr>
            </tbody>
        </table>
        <form onsubmit = "return toDatabase()" id = "editorForm">
            <input style ="margin-left: 2px; width: 180px;" type="text" maxlength="25" id = "listName" placeholder = "List name" value="<?= $list['name'] ?>" required> <br> <br>
            <button id = "editTaskSubmit" type = "submit"> Submit </button> <br>
            <input type="hidden" id = "editListID" name = "listID" value="<?= $list['id']?>"> <br>
        </form>
    </div>

    <div>


    <button type ="submit" onclick = "window.location='../main';"> Go Back </button> <br> <br>

    </div>
</section>

<script>
    function toDatabase()
    {
        let listName = document.getElementById("listName").value;
        let listID = document.getElementById("editListID").value;
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function()
        {
        if (this.readyState == 4 && this.status == 200)
        {
            if(this.responseText == 0)
            {
                window.location.href = "../main";
                return true;
            }
            else
            {
                var message = "Error inserting into database";
                document.getElementById("message").innerHTML = message;
                document.getElementById("message").classList.add('error');
                document.getElementById("message").classList.remove('hidden');
                return true;
            }
        }
        };

        xhttp.open("POST", "../list_management/editListToDatabase.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("listID=" + listID + "&listName=" + listName);
        return false;
    }
</script>
