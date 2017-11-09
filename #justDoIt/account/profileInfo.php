<body>

    <section id="profile">
      <h1> <?= $user['username']; ?> </h1>
      <div id="pic">
        PROFILE <br> PICTURE
      </div>
      <div id="info">
        <h4> Email </h4>
        <p> <?= $user['email']; ?> </p>
        <h4> Name </h4>
        <p> <?= $user['name']; ?> </p>
        <h4> Register Date </h4>
        <p> <?= $user['registerDate']; ?> </p>
      </div>
      <br>
      <div id="editProfileButton">
      <a href = "profileEditor.php"> Edit Profile </a>
    </div>
    </section>

</body>
