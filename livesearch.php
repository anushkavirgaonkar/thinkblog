
<?php

$q=$_GET["q"];

$con = mysqli_connect('localhost','root','','users');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

$sql="SELECT blog_name FROM blogs WHERE blog_name LIKE '%".$q."%' UNION SELECT tag_name FROM tags WHERE tag_name LIKE '%".$q."%' UNION SELECT username FROM users WHERE username LIKE '%".$q."%'";
$result = mysqli_query($con,$sql);

$x=0;
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
	echo '<button type="button" id="'.$x.'" class="btn btn-light" onclick="updateSearch('.$x.')">' . $row["blog_name"] .'</button> ';
	$x = $x+1;
}


mysqli_close($con);

?>
