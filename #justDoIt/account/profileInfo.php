<body>

    <section id="profile">
      <h1> <?= $user['username']; ?> </h1>
      <div id="pic">
      <p> <img src="<?=$user['profilePicture']?>" alt="Defaul Profile Picture" style="width:138px;height:200px;"> </p>

      <form action="upload.php" method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
      </form>
      
      </div>
      <div id="info">
        <h4> Email </h4>
        <p> <?= $user['email']; ?> </p>
        <h4> Name </h4>
        <p> <?= $user['name']; ?> </p>
        <h4> Birthday </h4>
        <p> <?= date("d/m/Y", $user['birthday']/1000) ?> </p>
        <h4> Location </h4>
        <p> <?= $user['location']; ?> </p>
        <h4> Register Date </h4>
        <p> <?= $user['registerDate']; ?> </p>
      </div>
      <br>
      <div id="editProfileButton">
      <a href = "profileEditor.php"> Edit Profile </a>
    </div>
    </section>

</body>
