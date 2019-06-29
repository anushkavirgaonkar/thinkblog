<?php
session_start();
?>
<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<head>
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
        <a class="nav-link" href="register.php">Register</a>
      </li>
    </ul>
  </div>
</nav>

  <div class="loginbox">
   <form name="myForm" method="POST" class="container"  id = "login"  >
	<p class="textinform">USERNAME</p>
	<input name="funame" type="text" required></input>
	</br>
	<p class="textinform">PASSWORD</p>
	<input name="fpass" type="password" required></input>
	</br>
	<button type="submit" class="buttoninform"><b>SUBMIT</b></button>
  </div>

</body>
</html>

<?php
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
	   
      // username and password sent from form 
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

      $sql = "SELECT username FROM users WHERE username = '$uname' and password = '$pass'";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      $active = $row['active'];
      
      $count = mysqli_num_rows($result);
      
      // If result matched $myusername and $mypassword, table row must be 1 row
		
      if($count == 1) {
         $_SESSION["login_user"] = $uname;
         header("location: home.php");
      }else {
         echo 	"Your Login Name or Password is invalid";
      }
   
	$conn->close();

}

?>