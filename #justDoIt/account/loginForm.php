<body>
    <?php if(!empty($message)): ?>
        <p><?= $message ?> </p>
    <?php endif; ?>

    <section id="login">
    <h1> Login </h1>
    <form action "login.php" method = "POST">
        <input type = "text" placeholder = "username" name = "username"> <br>
        <input type = "password" placeholder = "password" name = "password"> <br> <br>
        <button id="loginSubmit" type = "submit"> Submit </button>
    </form>
  </section>
</body>
