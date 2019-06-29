<html>
<body>
<?php

	$rollno = $_POST["rollno"];
	$name = $_POST["name"];
	if(isset($_POST["comp"]))
	{	
		$dept="Comp";
	}
		
	if(isset($_POST["it"]))
	{	
		$dept="IT";
	}
	
	if(isset($_POST["entc"]))
	{	
		$dept="EnTC";
	}
	
	$server = "localhost";
	$username = "root";
	$password = "";
	$db = "users";
	
	$conn = new mysqli($server , $username , $password , $db);
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	$sql = "SELECT rollno FROM student VALUES ('$rollno' , '$name' , '$dept')";
	if ($conn->query($sql) == TRUE) {
		echo "Your response has been recorded";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	$conn->close();

?>
</body>
</html>