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
	    if(!$_SESSION["login_user"])
		{
			header("location: index.html");
		}
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
    <form autocomplete="off" class="form-inline my-2 my-lg-0" method="POST" action="display.php">
      <input class="form-control mr-sm-2" type="text" size="30" name = "searchbar" id="searchbar" onkeyup="showResult(this.value)" placeholder="Search">
		<div class="btn-group-vertical" id="livesearch"></div>
	  <button class="btn btn-outline-success my-2 my-sm-0" id="searchblog" name="searchblog" type="submit">Search</button>
    </form>
  </div>
</nav>


<div class="jumbotron" style="text-align: center;" >

  <h4 >PICT presents</h4>
  <h2 class="display-4" >ThinkBlog:</br><center> Where your blogging </br> dreams come true!<center></h2>
  <p class="lead" style="margin:auto;" >ThinkBlog is a platform where you can pour your heart out.</p>
  <p class="lead" style="margin:auto;"> Go ahead and start blogging!</p><br>
<a class="btn btn-primary btn-lg" href="write.php" role="button">Write now!</a>
 <hr class="my-4">
  <h4> Contact Us:</h4>
  <p> thinkblog@gmail.com </p>
</div>

</body>
</html>