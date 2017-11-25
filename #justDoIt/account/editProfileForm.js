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
