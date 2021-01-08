 <!--
Name = Arjun Kumar Gupta
Student Id = 20103877
Practical Class Time = Tuesday 18:00 to 20:00
-->
<!DOCTYPE html>
<html>
<head>
<link rel = "stylesheet" href = "mi.css">
</head>
<script>
function myFun()
{
	var a = document.getElementById("b");
	if(a == "")
	{
		alert("Enter");
	}	
}
</script>
<body >
<div id = "a"><a href = "login.php">Login</a>
</div>
<h1>24/7 Music</h1>
	<form id="music" class = "myForm" action="search.php" method="get">
    <p id = "cen">Search</p>
    <p id = "cen">
      <input type="text"name="sound" class = "b" id = "b" placeholder="Track/Album/Artist">
      </p>
      <p id = "error"></p>
      <p id = "cen">
      <input type="submit" value="Search" onclick = "myFun()">
    </p>
  </form>
</body>
</html>
<?php
if(!isset($_GET['sound'])) {
return;
}
$id = $_GET['sound'];
require_once("conn.php");

$sql = "SELECT  track.spotify_track, track.track_title, artist.artist_name, album.album_name FROM track INNER JOIN album ON track.album_id = album.album_id INNER JOIN artist ON track.artist_id = artist.artist_id WHERE track.track_title= '$id'";
$res1 = $dbConn->query($sql)
or die ('Problem with query: ' . $dbConn->error); ?>

	<?php if(mysqli_num_rows($res1)>0){ ?>
	
<table border = "2" align = "center">
	<tr>
		<th>Track Title </th> 
		<th>Album Name</th> 
		<th>Artist Name</th>
	</tr>
	<?php
	while ($row = $res1->fetch_assoc()) { ?> 

		<tr>
			<td><a href = "play.php?sound=<?php echo $row["track_title"]?>"><?php echo $row["track_title"]?></a></td>
			<td><a href = "play.php?album=<?php echo $row["album_name"]?>"><?php echo $row["album_name"]?></a></td>
			<td><a href = "play.php?artist=<?php echo $row["artist_name"]?>"><?php echo $row["artist_name"]?></a></td>
			</tr>
		</table>
<?php
	}
	}
else{
$sql1 = "SELECT track.spotify_track, track.track_title, album.album_name, artist.artist_name FROM track INNER JOIN album ON track.album_id = album.album_id INNER JOIN artist ON track.artist_id = artist.artist_id WHERE album.album_name= '$id'";
$res2 = $dbConn->query($sql1)
or die ('Problem with query: ' . $dbConn->error); ?>
	
	<?php if(mysqli_num_rows($res2)>0){?>
	
<table border = "2" align = "center">
	<tr>
		<th>Track Title </th> 
		<th>Album Name</th> 
		<th>Artist Name</th>
		
	</tr>
	<?php
	while ($row = $res2->fetch_assoc()) { ?> 

		<tr>

			<td><a href = "play.php?sound=<?php echo $row["track_title"]?>"><?php echo $row["track_title"]?></a></td>
			<td><a href = "play.php?album=<?php echo $row["album_name"]?>"><?php echo $row["album_name"]?></a></td>
			<td><a href = "play.php?artist=<?php echo $row["artist_name"]?>"><?php echo $row["artist_name"]?></a></td>
			
			<?php }
		
	}
	
else{
$sql2 = "SELECT track.spotify_track, track.track_title, album.album_name, artist.artist_name FROM track INNER JOIN album ON track.album_id = album.album_id INNER JOIN artist ON track.artist_id = artist.artist_id WHERE artist.artist_name= '$id'";
$res3 = $dbConn->query($sql2)
or die ('Problem with query: ' . $dbConn->error); ?>
	
	<?php if(mysqli_num_rows($res3)>0){?>
	
<table border = "2" align = "center">
	<tr>
		<th>Track Title </th> 
		<th>Album Name</th> 
		<th>Artist Name</th>
		
	</tr>
	<?php
	while ($row = $res3->fetch_assoc()) { ?> 

		<tr>

			<td><a href = "play.php?sound=<?php echo $row["track_title"]?>"><?php echo $row["track_title"]?></a></td>
			<td><a href = "play.php?album=<?php echo $row["album_name"]?>"><?php echo $row["album_name"]?></a></td>
			<td><a href = "play.php?artist=<?php echo $row["artist_name"]?>"><?php echo $row["artist_name"]?></a></td>
			<?php }
			?>
		</tr>
		</table>
<?php
	}
	}}
?>
<?php $dbConn->close();?>
