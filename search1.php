 <!--
Name = Sumit Verma
Student Id = 20103936
Practical Class Time = Tuesday 18:00 to 20:00
-->
<?php
SESSION_start();
$d= $_SESSION["member"];
?>
<!DOCTYPE html>
<html>
<head>
<link rel = "stylesheet" href = "web.css">
<title>Welcome To 24/7 Music</title>
</head>
<body >
<div id = "logot"><a href = "logout.php">Logout</a></div>
<div id = "playlist"><a href = "playlist.php"> Your Playlists</a></div>
<p  id = "column" align = "right"> Hi <?php echo $_SESSION["user"];?> </p>
<p id = "column" align = "right"> Membership Type - <?php echo $_SESSION["category"];?></p>
<h1>24/7 Music</h1>
	<form id="mymusic" action="search1.php" method="get">
    <p id = "center">Search </p>
    <p id = "center">
      <input type="text"name="select" id = "search" placeholder="Search your favourite music">
      </p>
      <p id = "center">
      <input type="submit" value="Search">
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

$mysql = "SELECT  track.spotify_track, track.track_title, artist.artist_name, album.album_name FROM track INNER JOIN album ON track.album_id = album.album_id INNER JOIN artist ON track.artist_id = artist.artist_id WHERE track.track_title= '$id'";
$result = $dbConn->query($mysql)
or die ('Problem with query: ' . $dbConn->error); ?>

	<?php if(mysqli_num_rows($result)>0){ ?>
	
<table border = "1" align = "center">
	<tr>
		<th>Track Title </th> 
		<th>Artist Name</th> 
		<th>Album Name</th>
	</tr>
	<?php
	while ($row = $result->fetch_assoc()) { ?> 

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
$mysql1 = "SELECT track.spotify_track, track.track_title, album.album_name, artist.artist_name FROM track INNER JOIN album ON track.album_id = album.album_id INNER JOIN artist ON track.artist_id = artist.artist_id WHERE album.album_name= '$id'";
$result1 = $dbConn->query($mysql1)
or die ('Problem with query: ' . $dbConn->error); ?>
	
	<?php if(mysqli_num_rows($result1)>0){?>
	
<table border = "2" align = "center">
	<tr>
		<th>Track Title </th> 
		<th>Album Name</th> 
		<th>Artist Name</th>
		
	</tr>
	<?php
	while ($row = $result1->fetch_assoc()) { ?> 

		<tr>

			<td><a href = "play.php?sound=<?php echo $row["track_title"]?>"><?php echo $row["track_title"]?></a></td>
			<td><a href = "play.php?album=<?php echo $row["album_name"]?>"><?php echo $row["album_name"]?></a></td>
			<td><a href = "play.php?artist=<?php echo $row["artist_name"]?>"><?php echo $row["artist_name"]?></a></td>
			
			<?php }
		
	}
	
else{
$mysql2 = "SELECT track.spotify_track, track.track_title, album.album_name, artist.artist_name FROM track INNER JOIN album ON track.album_id = album.album_id INNER JOIN artist ON track.artist_id = artist.artist_id WHERE artist.artist_name= '$id'";
$result2 = $dbConn->query($mysql2)
or die ('Problem with query: ' . $dbConn->error); ?>
	
	<?php if(mysqli_num_rows($result2)>0){?>
	
<table border = "2" align = "center">
	<tr>
		<th>Track Title </th> 
		<th>Album Name</th> 
		<th>Artist Name</th>
		
	</tr>
	<?php
	while ($row = $result2->fetch_assoc()) { ?> 

		<tr>

			<td><a href = "play.php?sound=<?php echo $row["track_title"]?>"><?php echo $row["track_title"]?></a></td>
			<td><a href = "play.php?album=<?php echo $row["album_name"]?>"><?php echo $row["album_name"]?></a></td>
			<td><a href = "play.php?artist=<?php echo $row["artist_name"]?>"><?php echo $row["artist_name"]?></a></td>
			<?php 
	}

			?>
		</tr>
		</table>
<?php
	}
	
	}
}
?>
<?php $dbConn->close();?>
