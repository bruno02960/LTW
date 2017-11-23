<body>
    <?php if(!empty($message)){ ?>
        <p id = "errorMessage"><?= $message ?> </p>
    <?php }; ?>

    <section id="login">
    <h1> Login </h1>
    <form id="loginForm" action "login.php" method = "POST">
        <input type = "text" placeholder = "username" name = "username"> <br>
        <input type = "password" placeholder = "password" name = "password"> <br> <br>
        <button id="loginSubmit" type = "submit"> Submit </button>
    </form>
  </section>
</body>
