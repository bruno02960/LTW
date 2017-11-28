<body>

    <section id="profile">
      <h1> <?= $user['username']; ?> </h1>
      <div id="pic">
      <p> <img src="<?=$user['profilePicture']?>" alt="Profile Picture" style="width:138px;height:200px;"> </p>

      </div>
      <div id="info">
        <h4> Email </h4>
        <p> <?= $user['email']; ?> </p>
        <h4> Name </h4>
        <p> <?= $user['name']; ?> </p>
        <h4> Birthday </h4>
        <p> <?= date('d/m/Y', $user['birthday']) ?> </p>
        <h4> Location </h4>
        <p> <?= $user['location']; ?> </p>
        <h4> Register Date </h4>
        <p> <?= date('d/m/Y', $user['registerDate']) ?> </p>
      </div>
      <br>
      <div id="editProfileButton">
      <a href = "profileEditor.php"> Edit Profile </a>
    </div>
    <br>
    </section>

</body>
