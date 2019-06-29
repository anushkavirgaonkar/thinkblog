<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<title>ThinkBlog</title>
 
<link rel="stylesheet" type="text/css" href="style.css">
</head>

<body style="background-image:url('img.jpg');  height:100%; background-position: center;
 background-repeat: no-repeat; background-size: cover;">
 <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="#">ThinkBlog</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="index.html">Home</a>
      </li>
	  <li class="nav-item active">
        <a class="nav-link" href="login.php">Login</a>
      </li>
    </ul>
  </div>
</nav>
  <div class="registerbox">
   <form name="myForm" method="POST"  id = "register" onsubmit="return validateForm()" >
     <p  class="textinform">FIRST NAME</p>
	<input name="fname" type="text"></input>
	<br>
	<p  class="textinform">LAST NAME</p>
	<input name="lname" type="text"></input>
	<br>
	<p class="textinform">AGE</p>
	<input name="fage" type="number" required></input>
	<br>
	<p class="textinform">EMAIL</p>
	<input name="fmail" type="text" required></input>
	<br>
	<p class="textinform">USERNAME</p>
	<input name="funame" type="text" required></input>
	<br>
	<p class="textinform">PASSWORD</p>
	<input name="fpass" type="password" required></input>
	<br>
	<p class="textinform"> CONFIRM PASSWORD</p>
	<input name="fcpass" type="password" required></input>
	<br>
	<button type="submit" class="buttonregister"><b>SUBMIT</b></button>
  </div>

<script type="text/javascript">
function validateForm() {
	
	
	var x= document.forms["myForm"]["fpass"].value;
	if(x.length<6)
	{
		alert("password should be at least 6 characters.");
		return false;
	}

	var y= document.forms["myForm"]["fcpass"].value;
	if (x != y) {
   		 alert("Password and Confirmed password should match");
  	  return false;
 	 }

	var u=document.forms["myForm"]["fage"].value;
	if(u<12)
	{
		alert("Age must be greater than 12");
	return false;
	}
return true;
} 
</script>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$age = $_POST['fage'];
	$email = $_POST['fmail'];
	$uname = $_POST['funame'];
	$pass = $_POST['fpass'];

	// sql connectivity

	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "users";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $db);

	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "INSERT INTO users VALUES ('$fname', '$lname', '$age' , '$email' , '$uname' , '$pass' )";

	if ($conn->query($sql) == TRUE) {
		 header("Location: login.php"); /* Redirect browser */
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

}

?>
<html>
</body>
</html>
