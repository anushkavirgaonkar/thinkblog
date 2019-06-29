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

<?php
$user = $_SESSION["login_user"];
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

$sql = "SELECT first_name, last_name, age FROM users WHERE username = '$user'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
	
	echo "<h2>Name: ";
	echo $row["first_name"] . " " . $row["last_name"] ."</h2><br>";
	echo "<h2>Age: ";
	echo $row["age"] . "</h2><br>";
}

echo "<h4>Blogs </h4><br>";
$sql1 = "SELECT blog_name, blog_author, blog_desc, tags FROM blogs WHERE blog_author = '$user'";
$result1 = mysqli_query($conn,$sql1);
while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) {
	
	echo '<div class="card" style="width: 18rem; margin:auto; width:500px;">';
	echo '<div class="card-body">';
	echo '<h5 class="card-title">' . $row1["blog_name"] .'</h5>';
	echo '<h6 class="card-subtitle mb-2 text-muted">' .$row1["blog_author"] . '</h6>';
	echo '<p class="card-text">' . $row1["blog_desc"] . '<br><br>';
	
	
	echo "Tags:<br>";
	$unserialized_array = unserialize($row1['tags']);
		$arrlength = count($unserialized_array);
			for($x = 0; $x < $arrlength; $x++) {
				$sql2="SELECT tag_name FROM tags WHERE tag_id = '$unserialized_array[$x]'";
				$result2 = mysqli_query($conn,$sql2);
				while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {
					echo $row2["tag_name"];
					echo "<br>";
				}
			}
	echo '</p>';
	echo '</div>';
	echo '</div>';
}
$conn->close();
?>
<hr class="my-4">
  <h4> Contact Us:</h4>
  <p> thinkblog@gmail.com </p>
</div>
</body>
</html>