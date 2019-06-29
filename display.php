<?php
session_start();
?>
<html>
<head>
<script>
function showResult(str) {
  if (str.length==0) { 
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else {  // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("livesearch").innerHTML=this.responseText;
      document.getElementById("livesearch").style.border="1px solid #A5ACB2";
    }
  }
  xmlhttp.open("GET","livesearch.php?q="+str,true);
  xmlhttp.send();
}
function updateSearch(x) {
  document.getElementById("searchbar").value = document.getElementById(x).innerText;
}
</script>
<title>ThinkBlog</title>
<link rel="stylesheet" type="text/css" href="style1.css">

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
	$blog_name = $_POST["searchbar"];
	// sql connectivity

	$servername = "localhost";
	$username = "root";
	$password = "";
	$db = "users";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $db);

	$sqltag = "SELECT tag_id FROM tags WHERE tag_name = '$blog_name'";
	$resulttag = mysqli_query($conn,$sqltag);
    $count = mysqli_num_rows($resulttag);  
    if($count == 0) {
		
		$sql="SELECT blog_name , blog_author , blog_desc , tags FROM blogs WHERE blog_name = '$blog_name'";
		$result = mysqli_query($conn,$sql);
		
			
		while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
			
			echo '<div class="card" style="width: 18rem; margin:auto; width:500px;">';
			echo '<div class="card-body">';
			echo '<h5 class="card-title">' . $row["blog_name"] .'</h5>';
			echo '<h6 class="card-subtitle mb-2 text-muted">' .$row["blog_author"] . '</h6>';
			echo '<p class="card-text">' . $row["blog_desc"] . '<br><br>';
			echo "Tags:<br>";
			
			$unserialized_array = unserialize($row['tags']);
			$arrlength = count($unserialized_array);
			for($x = 0; $x < $arrlength; $x++) {
				
				$sql1="SELECT tag_name FROM tags WHERE tag_id = '$unserialized_array[$x]'";
				$result1 = mysqli_query($conn,$sql1);
				while($row1 = mysqli_fetch_array($result1,MYSQLI_ASSOC)) {
					
					echo $row1["tag_name"];
					echo "<br>";
				}
			}
			echo '</p>';
			echo '</div>';
			echo '</div>';
		}
	}
	else
	{
		echo "";
		while($rowtag = mysqli_fetch_array($resulttag,MYSQLI_ASSOC)) {
		
		$sqlblog="SELECT blog_name , blog_author , blog_desc , tags FROM blogs";
		$resultblog = mysqli_query($conn,$sqlblog);	
		while($rowblog = mysqli_fetch_array($resultblog,MYSQLI_ASSOC)) {
			$unserialized_array1 = unserialize($rowblog['tags']);
			$arrlength1 = count($unserialized_array1);
			for($x = 0; $x < $arrlength1; $x++) {
				
				if($rowtag["tag_id"]==$unserialized_array1[$x])
				{
					echo '<div class="card" style="width: 18rem; margin:auto; width:500px;">';
					echo '<div class="card-body">';
					echo '<h5 class="card-title">' . $rowblog["blog_name"] .'</h5>';
					echo '<h6 class="card-subtitle mb-2 text-muted">' .$rowblog["blog_author"] . '</h6>';
					echo '<p class="card-text">' . $rowblog["blog_desc"] . '<br><br>';
					echo '</p>';
					echo '</div>';
					echo '</div>';
				}
			}
		}
		}
	}
	
	$sqluser = "SELECT username FROM users WHERE username = '$blog_name'";
	$resultuser = mysqli_query($conn,$sqluser);
    $count = mysqli_num_rows($resultuser);  
    if($count == 1) {
		
		$sql2="SELECT blog_name , blog_author , blog_desc , tags FROM blogs WHERE blog_author = '$blog_name'";
		$result2 = mysqli_query($conn,$sql2);
		
			
		while($row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC)) {
			
			echo '<div class="card" style="width: 18rem; margin:auto; width:500px;">';
			echo '<div class="card-body">';
			echo '<h5 class="card-title">' . $row2["blog_name"] .'</h5>';
			echo '<h6 class="card-subtitle mb-2 text-muted">' .$row2["blog_author"] . '</h6>';
			echo '<p class="card-text">' . $row2["blog_desc"] . '<br><br>';
			echo "Tags:<br>";
			
			$unserialized_array2 = unserialize($row2['tags']);
			$arrlength2 = count($unserialized_array2);
			for($x = 0; $x < $arrlength2; $x++) {
				
				$sql3="SELECT tag_name FROM tags WHERE tag_id = '$unserialized_array2[$x]'";
				$result3 = mysqli_query($conn,$sql3);
				while($row3 = mysqli_fetch_array($result3,MYSQLI_ASSOC)) {
					
					echo $row3["tag_name"];
					echo "<br>";
				}
			}
			echo '</p>';
			echo '</div>';
			echo '</div>';
		}
	}
	mysqli_close($conn);

?>
  <hr class="my-4">
  <h4> Contact Us:</h4>
  <p> thinkblog@gmail.com </p>
</div>

</body>
</html>