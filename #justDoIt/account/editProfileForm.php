<section id="editProfile">
    <h2> Edit Profile </h2>

    <p id = "errorMessage"> </p>

    <form id = "editorForm" action="profileEditor.php" method = "POST" onkeypress="return keyListener(event)">
        <label for="usernameInput">Username:</label> <br>
        <input id = "usernameInput" type = "text" placeholder = "Username" name = "username" value = "<?= $user['username'] ?>"> <br>
        <label for="emailInput">Email:</label> <br>
        <input id = "emailInput" type = "email" placeholder = "Email" name = "email" value = "<?= $user['email'] ?>"> <br>
        <label for="nameInput">Name:</label> <br>
        <input id = "nameInput" type = "text" placeholder = "Name" name = "name" value = "<?= $user['name'] ?>"> <br>
        <label for="locationInput">Location:</label> <br>
        <input id = "locationInput" type = "text" placeholder = "Location" name = "location" value = "<?= $user['location'] ?>"> <br>
        <input id = "sendForm" type = "submit" class = "hidden"> <br>
        <button id = "editProfileSubmit" type = "button"> Submit </button>
    </form>

    <h2> Profile Picture </h2>
    <div id="uploadPhoto">
        <form action = "upload.php" method = "POST" onsubmit ="return checkImage()" enctype="multipart/form-data">
          <input class = "hidden" type="file" name="fileToUpload" id="fileToUpload" onchange="pressed()">
          <label id="uploadLabel" for="fileToUpload"> Choose a profile picture... </label>
          <input type = "submit" class = "hidden">
          <input class = "buttonCursor" id="submitPhoto" type="submit" value="Upload" name="submit">
        </form>
    </div>
</section>
<script src="editProfileForm.js">
</script>
