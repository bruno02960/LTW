<body>
    <p id = "errorMessage"> </p>
    <section id="register">
        <h1> Register </h1>

        <form id = "registerForm" action "register.php" method = "POST" onkeypress="return keyListener(event)" enctype="multipart/form-data">
            <input id = "emailInput" type = "email" placeholder = "email" required name = "email" required> <br>
            <input id = "usernameInput" type = "text" placeholder = "username" name = "username" required> <br>
            <input id = "nameInput" type = "text" placeholder = "name" name = "name" required> <br>
            <input id = "dateInput" type = "text" placeholder = "birthday (mm/dd/year)" name = "birthday" required> <br>
            <input id = "locationInput" type = "text" placeholder = "location" name = "location"> <br>
            <input id = "passwordInput" type = "password" placeholder = "password" name = "password" required><br>
            <input id = "confirmPasswordInput" type = "password" placeholder = "confirm password" name = "confirm_password" required> <br>
            <input id = "fileToUpload" class = "buttonCursor" type="file" name="fileToUpload"> <br>
            <p id="strLog">Password Strength=No Password</p>
            <input id = "sendForm" type = "submit" class = "hidden"> <br>
            <button id = "registerSubmit" type = "button"> Submit </button>
        </form>
    </section>
    <script>
        function passwordStrengthCalc(password){
            var specialChar = "!$%^&*_@#~?";
            var passwordScore =0;

            var regexPW = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*\\d)[a-zA-Z!$%^&*_@#~?\\d]{8,72}$");

            if(regexPW.test(password)){

                 //for each special character in the password 20 points are added to the password score
                for(let i=0;i<password.length;++i){
                    if(specialChar.indexOf(password.charAt(i))>-1){
                        passwordScore += 20;
                    }
                }

                 //if the password has lower case letter 20 points are added to its score
                if(/[a-z]/.test(password)){
                    passwordScore+=20;
                }

                 //if the password has upper case letter 20 points are added to its score
                if(/[A-Z]/.test(password)){
                    passwordScore+=20;
                }

                 //if the password has a number 20 points are added to its score
                if(/[\d]/.test(password)){
                    passwordScore+=20;
                }

                 //if the passwords lenghts is biger than 8 20 points are added to its score
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
                }else{
                    return "Very Low Security";
                }
                
                
            }else{
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
                        log.innerHTML = ("Password Strength="+score);
                    }
                }
            }
        }
        
        
    </script>
</body>

<script src="registerForm.js"></script>
</html>
