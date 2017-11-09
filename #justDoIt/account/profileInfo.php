<body>

    <section id="profile">
      <h1> <?= $user['username']; ?> </h1>
      <div id="pic">
      <img src="<?=$user['profilePicture']?>" alt="Defaul Profile Picture" style="width:138px;height:200px;">
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
