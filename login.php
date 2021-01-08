<!DOCTYPE html>
<html>
<head>
	<title>Welcome To 24/7 Music</title>
	<link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>

	<div id="loginback">
		<h1>Please Enter Your Details</h1>
		<form id="loginform" class="logf" action="login.php" method="post">
			<p><label for="username">Username:</label>
			<input type="text" name="username" id="un"></p>
			<p><label for="password">Password: </label>
			<input type="password" name="password" id="pass"></p>
			<input type="submit" name="submitbutton" id="loginbutton">
		</form>
	</div>

</body>
</html>
<?php
require("conn.php");
if(isset($_POST['password']) and isset($_POST['username'])) {
$passw = hash("sha256",$_POST['password']);
$un = $_POST['username'];
$mysql = "SELECT  * FROM `membership` WHERE password = '$passw' and username='$un'";
$result = $dbConn->query($mysql)
or die ('Problem with query: ' .$dbConn->error); 
?>
<?php 
$row = $result->fetch_assoc();
$cat=$row["category"];
$fn= $row["firstname"];
$sur= $row["surname"];
$mem=$row["member_id"];
$total = mysqli_num_rows($result);
if($total == 1)
{
	$_SESSION["user"]=$un;
	$_SESSION["surname"]=$sur; 
	$_SESSION["category"]=$cat;
	$_SESSION["member"]=$mem;
	header("location: search1.php");
}
else
{
	echo "<script> alert('Invalid Username and password') </script>";
}
} 
?>