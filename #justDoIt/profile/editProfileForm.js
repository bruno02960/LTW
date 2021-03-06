var submitButton = document.getElementById("editProfileSubmit");
var form = document.getElementById("editorForm");

function keyListener(e) {
    if (e.keyCode == 13) {
        submitButton.click();
        return false;
    }
}

pressed = function() {
    var a = document.getElementById('fileToUpload');
    if (a.value == "") {
        uploadLabel.innerHTML = "Choose file";
    } else {
        var theSplit = a.value.split('\\');
        uploadLabel.innerHTML = theSplit[theSplit.length - 1];
    }
};

submitButton.addEventListener("click", function(event) {
    event.preventDefault();
    document.getElementById("errorMessage").classList.value = '';
    document.getElementById("errorMessage").classList.add('hidden');
    document.getElementById("errorMessage").classList.add('error');

    var email = document.getElementById("emailInput").value;
    var username = document.getElementById("usernameInput").value;
    var name = document.getElementById("nameInput").value;
    var location = document.getElementById("locationInput").value;

    if (username.length < '8') {
        var message = "Your Username Must Contain At Least 8 Characters!";
        document.getElementById("errorMessage").innerHTML = message;
        document.getElementById("errorMessage").classList.remove('hidden');
        return;
    }

    if (email.length == '0') {
        var message = "Email can't be empty"
        document.getElementById("errorMessage").innerHTML = message;
        document.getElementById("errorMessage").classList.remove('hidden');
        return;
    }

    if (name.length == '0') {
        var message = "Name can't be empty"
        document.getElementById("errorMessage").innerHTML = message;
        document.getElementById("errorMessage").classList.remove('hidden');
        return;
    }

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            if (xhttp.responseText == -1) {
                var message = "This username is already in use!";
                document.getElementById("errorMessage").innerHTML = message;
                document.getElementById("errorMessage").classList.remove('hidden');
                return;
            } else if (xhttp.responseText == -2) {
                var message = "This email is already in use!";
                document.getElementById("errorMessage").innerHTML = message;
                document.getElementById("errorMessage").classList.remove('hidden');
                return;
            } else
                document.getElementById("sendForm").click();
        }
    }

    xhttp.open("POST", "checkDuplicatesEditing.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("username=" + username + "&email=" + email + "&location=" + location);
});

function checkImage() {
    let submitPhoto = document.getElementById("fileToUpload").files[0];
    let fileExtension = submitPhoto.name.split('.').pop();

    if (submitPhoto == null) {
        let message = "No image selected";
        document.getElementById("errorMessage").innerHTML = message;
        document.getElementById("errorMessage").classList.remove('hidden');
        return false;
    } else if (fileExtension != 'png' && fileExtension != 'PNG' 
                && fileExtension != 'jpg' && fileExtension != 'jpeg' 
                && fileExtension != 'JPG' && fileExtension != 'JPEG'
                && fileExtension != 'bmp' && fileExtension != 'BMP') {
        let message = "File selected isn't a valid image file";
        document.getElementById("errorMessage").innerHTML = message;
        document.getElementById("errorMessage").classList.remove('hidden');
        return false;
    } else
        return true;

    return false;
}
