<?php
session_start();
?>
<html>
<head>
<title>ThinkBlog</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body style="background-color:black;">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">ThinkBlog</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home</a>
      </li>
      <li class="nav-item">
	  <?php
		echo '<a class="nav-link" href="home.php"  style="color:white;">' .$_SESSION["login_user"] . '</a>';
	  ?>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="profile.php">Profile</a>
      </li>
	  <li class="nav-item active">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" method="POST" action="display.php">
      <input class="form-control mr-sm-2" type="text" size="30" name = "searchbar" id="searchbar" onkeyup="showResult(this.value)" placeholder="Search">
		<div class="btn-group-vertical" id="livesearch"></div>
	  <button class="btn btn-outline-success my-2 my-sm-0" id="searchblog" name="searchblog" type="submit">Search</button>
    </form>
  </div>
</nav>


<div class="jumbotron" style="text-align: center;" >
  <h4> Your blog has been submitted successfully!</h4>
 <br><br><br><br><br><br><br><br><br><br><br>
 <hr class="my-4">
  <h4> Contact Us:</h4>
  <p> thinkblog@gmail.com </p>
</div>

</body>
</html>