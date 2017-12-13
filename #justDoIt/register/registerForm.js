var submitButton = document.getElementById("registerSubmit");
var form = document.getElementById("registerForm");

pressed = function(){
    var a = document.getElementById('fileToUpload');

    if(a.value == "")
    {
        uploadLabel.innerHTML = "Choose file";
    }
    else
    {
        var theSplit = a.value.split('\\');
        uploadLabel.innerHTML = theSplit[theSplit.length-1];
    }
};

function passwordStrengthCalc(password){
    var specialChar = "!$%^&*_@#~?";
    var passwordScore = 0;
    var regexPW = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)[a-zA-Z!$%^&*_@#~?\\d]{8,72}$");

    if(regexPW.test(password))
    {
        for(let i=0;i<password.length;++i){
            if(specialChar.indexOf(password.charAt(i)) > -1){
                passwordScore += 20;
            }
        }

        if(/[a-z]/.test(password)){
            passwordScore+=20;
        }

        if(/[A-Z]/.test(password)){
            passwordScore+=20;
        }

        if(/[\d]/.test(password)){
            passwordScore+=20;
        }

        if(password.length>=8){
            passwordScore+=20;
        }

        if(passwordScore>=100){
            return "High Security";
        }

        if(passwordScore>=80){
            return "Medium Security";
        }

        if(passwordScore>=60){
            return "Low Security";
        }
        else
        {
            return "Very Low Security";
        }
    }
    else
    {
        return "Invalid Password";
    }
}

var form = document.querySelector('#registerForm');
if(form!=null){
    let input = form.querySelector('#passwordInput');
    if(input!=null){
        input.onchange = function(){
            let password = input.value;
            let score = passwordStrengthCalc(password);
            let log =form.querySelector('#strLog');
            if(log!=null){
                log.innerHTML = (score);
            }
        }
    }
}

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
    var birthday = document.getElementById("dateInput").value;
    var location = document.getElementById("locationInput").value;
    var PW = document.getElementById("passwordInput").value;
    var CPW = document.getElementById("confirmPasswordInput").value;
    var regexPW = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)[a-zA-Z!$%^&*_@#~?\\d]{8,72}$");

    var inputDate = document.getElementById("dateInput").value;
    var verifyDateFormat = /^(\d{2})-(\d{2})-(\d{4})$/;
    var validDateValue = /(^(((0[1-9]|1[0-9]|2[0-8])[-](0[1-9]|1[012]))|((29|30|31)[-](0[13578]|1[02]))|((29|30)[-](0[4,6,9]|11)))[-](19|[2-9][0-9])\d\d$)|(^29[-]02[-](19|[2-9][0-9])(00|04|08|12|16|20|24|28|32|36|40|44|48|52|56|60|64|68|72|76|80|84|88|92|96)$)/;
    var validYear = /(^(\d{1,2})-(\d{1,2})-(19[789]\d|20[01]\d)$)/;

    if (!inputDate.match(verifyDateFormat))
    {
        document.getElementById("errorMessage").innerHTML = "Please enter a dd-mm-yyyy date";
        document.getElementById("errorMessage").classList.remove('hidden');
        document.getElementById("errorMessage").classList.add('error');
        return;
    }
    else if(!inputDate.match(validDateValue))
    {
        document.getElementById("errorMessage").innerHTML = "Please enter a valid date";
        document.getElementById("errorMessage").classList.remove('hidden');
        document.getElementById("errorMessage").classList.add('error');
        return;
    }
    else if(!inputDate.match(validYear))
    {
        document.getElementById("errorMessage").innerHTML = "Year must be at least 1970 and lower than 2200";
        document.getElementById("errorMessage").classList.remove('hidden');
        document.getElementById("errorMessage").classList.add('error');
        return;
    }

    if(username.length < '8')
    {
        let message = "Your Username Must Contain At Least 8 Characters!";
        document.getElementById("errorMessage").innerHTML = message;
        document.getElementById("errorMessage").classList.remove('hidden');
        return;
    }

    if(!regexPW.test(PW))
    {
        let message = "Your password must contain a minimum of 8 characters, at least 1 uppercase letter, 1 lowercase letter and 1 one number";
        document.getElementById("errorMessage").innerHTML = message;
        document.getElementById("errorMessage").classList.remove('hidden');
        return;
    }

    if(PW != CPW)
    {
        let message = "The passwords don't match";
        document.getElementById("errorMessage").innerHTML = message;
        document.getElementById("errorMessage").classList.remove('hidden');
        return;
    }

    let submitPhoto = document.getElementById("fileToUpload").files[0];
    let fileExtension = submitPhoto.name.split('.').pop();

    if(submitPhoto == null)
    {
        let message = "No image selected";
        document.getElementById("errorMessage").innerHTML = message;
        document.getElementById("errorMessage").classList.remove('hidden');
        return false;
    }
    else if(fileExtension != 'png' && fileExtension != 'jpg' && fileExtension != 'jpeg')
    {
        let message = "File selected isn't a valid image file";
        document.getElementById("errorMessage").innerHTML = message;
        document.getElementById("errorMessage").classList.remove('hidden');
        return false;
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
    };

    xhttp.open("POST", "checkDuplicatesRegister.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("username=" + username + "&email=" + email);
});
