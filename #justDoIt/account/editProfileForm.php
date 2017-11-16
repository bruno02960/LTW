<body>
    <section id="editProfile">
        <h1> Edit Profile </h1>

        <p id = "errorMessage"> </p>

        <form id = "editorForm" action="profileEditor.php" method = "POST" onkeypress="return keyListener(event)">
            <label for="UsernameLabel">Username:</label> <br>
            <input id = "usernameInput" type = "text" placeholder = "Username" name = "username" value = "<?= $user['username'] ?>"> <br>
            <label for="EmailLabel">Email:</label> <br>
            <input id = "emailInput" type = "email" placeholder = "Email" name = "email" value = "<?= $user['email'] ?>"> <br>
            <label for="NameLabel">Name:</label> <br>
            <input id = "nameInput" type = "text" placeholder = "Name" name = "name" value = "<?= $user['name'] ?>"> <br>
            <label for="LocationLabel">Location:</label> <br>
            <input id = "locationInput" type = "text" placeholder = "Location" name = "location" value = "<?= $user['location'] ?>"> <br>
            <input id = "sendForm" type = "submit" class = "hidden"> <br>
            <button id = "editProfileSubmit" type = "button"> Submit </button>
        </form>

        <br>

        <h1> Photo </h1>
        <div id="uploadPhoto">
            <form action="upload.php" method="post" enctype="multipart/form-data">
                <input type="file" name="fileToUpload" id="fileToUpload" class="hidden">
                <label id="fileToUploadLabel" for="fileToUpload">Browse...</label>
                <input id="submitPhoto" type="submit" value="Upload" name="submit">
            </form>
        </div>
    </section>
</body>

<script>
    var submitButton = document.getElementById("editProfileSubmit");
    var form = document.getElementById("editorForm");

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
        document.getElementById("errorMessage").classList.value = '';
        document.getElementById("errorMessage").classList.add('hidden');
        document.getElementById("errorMessage").classList.add('error');

        var email = document.getElementById("emailInput").value;
        var username = document.getElementById("usernameInput").value;
        var name = document.getElementById("nameInput").value;
        var location = document.getElementById("locationInput").value;

        if(username.length < '8')
        {
            var message = "Your Username Must Contain At Least 8 Characters!";
            document.getElementById("errorMessage").innerHTML = message;
            document.getElementById("errorMessage").classList.remove('hidden');
            return;
        }

        if(email.length == '0')
        {
            var message = "Email can't be empty"
            document.getElementById("errorMessage").innerHTML = message;
            document.getElementById("errorMessage").classList.remove('hidden');
            return;
        }

        if(name.length == '0')
        {
            var message = "Name can't be empty"
            document.getElementById("errorMessage").innerHTML = message;
            document.getElementById("errorMessage").classList.remove('hidden');
            return;
        }

        if(location.length == '0')
        {
            var message = "Location can't be empty"
            document.getElementById("errorMessage").innerHTML = message;
            document.getElementById("errorMessage").classList.remove('hidden');
            return;
        }

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function()
        {
            if (xhttp.readyState == 4 && xhttp.status == 200)
            {
                if(xhttp.responseText == -1)
                {
                    var message = "This username is already in use!";
                    document.getElementById("errorMessage").innerHTML = message;
                    document.getElementById("errorMessage").classList.remove('hidden');
                    return;
                }
                else if(xhttp.responseText == -2)
                {
                    var message = "This email is already in use!";
                    document.getElementById("errorMessage").innerHTML = message;
                    document.getElementById("errorMessage").classList.remove('hidden');
                    return;
                }
                else
                    document.getElementById("sendForm").click();
            }
        }

        xhttp.open("POST", "checkDuplicatesEditing.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("username=" + username + "&email=" + email + "&location=" + location);
    });
</script>
