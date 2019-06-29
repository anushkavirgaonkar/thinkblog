<?php
session_start();
?><html>
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
	  ?></li>
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
<form method = POST>
  <div class="form-group">
    <label for="formGroupExampleInput">Title</label>
    <input type="text" name="title" class="form-control" id="formGroupExampleInput" placeholder="Title">
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Content</label>
    <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  
  <div class="form-group">
	<p> Tags: </p>
	<div class="form-check form-check-inline">
	  <input class="form-check-input" name="Health" type="checkbox" id="inlineCheckbox1" value="option1">
	  <label class="form-check-label" for="inlineCheckbox1">Health</label>
	</div>
	<div class="form-check form-check-inline">
	  <input class="form-check-input" name="Technology" type="checkbox" id="inlineCheckbox2" value="option2">
	  <label class="form-check-label" for="inlineCheckbox2">Technology</label>
	</div>
	<div class="form-check form-check-inline">
	  <input class="form-check-input" name="Relationships" type="checkbox" id="inlineCheckbox2" value="option2">
	  <label class="form-check-label" for="inlineCheckbox3">Relationships</label>
	</div>
	<div class="form-check form-check-inline">
	  <input class="form-check-input" name="Spirituality" type="checkbox" id="inlineCheckbox2" value="option2">
	  <label class="form-check-label" for="inlineCheckbox4">Spirituality</label>
	</div>
	<div class="form-check form-check-inline">
	  <input class="form-check-input" name="Education" type="checkbox" id="inlineCheckbox2" value="option2">
	  <label class="form-check-label" for="inlineCheckbox5">Education</label>
	</div>
	<div class="form-check form-check-inline">
	  <input class="form-check-input" name="Career" type="checkbox" id="inlineCheckbox2" value="option2">
	  <label class="form-check-label" for="inlineCheckbox6">Career</label>
	</div>
	<div class="form-check form-check-inline">
	  <input class="form-check-input" name="Life" type="checkbox" id="inlineCheckbox2" value="option2">
	  <label class="form-check-label" for="inlineCheckbox7">Life</label>
	</div><div class="form-check form-check-inline">
	  <input class="form-check-input" name="Inspiration" type="checkbox" id="inlineCheckbox2" value="option2">
	  <label class="form-check-label" for="inlineCheckbox8">Inspiration</label>
	</div><div class="form-check form-check-inline">
	  <input class="form-check-input" name="Work" type="checkbox" id="inlineCheckbox2" value="option2">
	  <label class="form-check-label" for="inlineCheckbox9">Work</label>
	</div>
  </div>
<button type="submit" class="btn btn-primary mb-2">Submit</button>
</form>

 <hr class="my-4">
  <h4> Contact Us:</h4>
  <p> thinkblog@gmail.com </p>
</div>

</body>
</html><?php

$tags = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	if(isset($_POST['Health']))
	{
		array_push($tags,'0');
	}
	if(isset($_POST['Technology']))
	{
		array_push($tags,'1');
	}
	if(isset($_POST['Relationships']))
	{
		array_push($tags,'2');
	}
	if(isset($_POST['Spirituality']))
	{
		array_push($tags,'3');
	}
	if(isset($_POST['Education']))
	{
		array_push($tags,'4');
	}
	if(isset($_POST['Career']))
	{
		array_push($tags,'5');
	}
	if(isset($_POST['Life']))
	{
		array_push($tags,'6');
	}
	if(isset($_POST['Inspiration']))
	{
		array_push($tags,'7');
	}
	if(isset($_POST['Work']))
	{
		array_push($tags,'8');
	}

	$serialized_array = serialize($tags); 
	// $unserialized_array = unserialize($serialized_array); 

	//$dbtags = var_dump($serialized_array); // gives back a string, perfectly for db saving!
	// var_dump($unserialized_array); // gives back the array again
	$blog_name = $_POST['title'];
	$blog_author = $_SESSION["login_user"];
	$blog_desc = $_POST['desc'];

	// sql connectivity

	 $servername = "localhost";
	 $username = "root";
	 $password = "";
	 $db = "users";

	 // Create connection
	 $conn = new mysqli($servername, $username, $password, $db);


	 $sql = "INSERT INTO blogs VALUES ('$blog_name', '$blog_author', '$blog_desc' , '$serialized_array')";

	 if ($conn->query($sql) == TRUE) {
		 echo("<script>location.href = 'submit.php';</script>");
	 } else {
		 echo "Error: " . $sql . "<br>" . $conn->error;
	 }

	 $conn->close();








}
?>