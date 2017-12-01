    <?php if(!empty($message)){ ?>
        <p id = "errorMessage"><?= $message ?> </p>
    <?php }; ?>

    <section id="login">
    <h2> Login </h2>
    <form id="loginForm" action = "login.php" method = "POST">
        <input type = "text" placeholder = "username" name = "username" required> <br>
        <input type = "password" placeholder = "password" name = "password" required> <br> <br>
        <button id="loginSubmit" type = "submit"> Submit </button>
    </form>
  </section>
