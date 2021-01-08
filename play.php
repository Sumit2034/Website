<!--
Name = Arjun Kumar Gupta
Student Id = 20103877
Practical Class Time = Tuesday 18:00 to 20:00
-->
<?php
SESSION_start();
$art= $_SESSION["playlist_id"];
?>
<!DOCTYPE html>
<html>
<head>
<link rel = "stylesheet" href = "web.css">
</head>
<body>
<h1>24/7 Music</h1>
<?php
require_once("conn.php");
if(isset($_GET['sound'])) {
$sound= $_GET['sound'];
$value=$sound;

$sql = "SELECT  track.spotify_track, track.track_title, track.track_length, artist.artist_name, album.album_name FROM track INNER JOIN album ON track.album_id = album.album_id INNER JOIN artist ON track.artist_id = artist.artist_id WHERE track.track_title= '$sound'";
$res1 = $dbConn->query($sql)
or die ('Problem with query: ' . $dbConn->error); 

if(mysqli_num_rows($res1)>0){ 
echo "<table border = '1' align = 'center'>
<tr>
	<th>Album</th>
	<th>Title</th>
	<th>Length</th>
	<th>play</th>
</tr>";

while($row=$res1->fetch_assoc()){ 

echo"<tr>";
echo"<td>".$row['album_name']."</td>";
echo"<td>".$row['track_title']."</td>";
echo"<td>".$row['track_length']."</td>";
echo"<td><iframe src='https://open.spotify.com/embed/track/".$row['spotify_track']."' width='300' height='380' frameborder='0' allowtransparency='true' allow='encrypted- media' ></iframe></td>";
echo"</tr>";
}
echo"</table>";
}	
}

if(isset($_GET['album'])) {
$album= $_GET['album'];
$value=$album;

$sql = "SELECT album.thumbnail, track.spotify_track, track.track_title, album.album_name, artist.artist_name FROM track INNER JOIN album ON track.album_id = album.album_id INNER JOIN artist ON track.artist_id = artist.artist_id WHERE album.album_name= '$album'";
$res1 = $dbConn->query($sql)
or die ('Problem with query: ' . $dbConn->error); 

if(mysqli_num_rows($res1)>0){ 
$row=$res1->fetch_assoc();
echo"<p id = 'h3col' align = 'center'>Thumbnail of the searched Album - </p>";
echo"<div align = 'center'><img id = 'c' src='/twa/thumbs/albums/".$row['thumbnail']."' width='130' height='130'></div>";

echo "<table border = '1' align = 'center'>
<tr>
	<th>Album</th>
	<th>Artist</th>
	<th>Track</th>
	<th>Play</th>
</tr>";

while($row=$res1->fetch_assoc()){ 

echo"<tr>";
echo"<td>".$row['album_name']."</td>";
echo"<td>".$row['artist_name']."</td>";
echo"<td>".$row['track_title']."</td>";
echo"<td><iframe src='https://open.spotify.com/embed/track/".$row['spotify_track']."' width='300' height='380' frameborder='0' allowtransparency='true' allow='encrypted- media' ></iframe></td>";
echo"</tr>";
}
echo"</table>";
}	
}


if(isset($_GET['artist'])) {
$artist= $_GET['artist'];
$value=$artist;

$sql = "SELECT artist.thumbnail, track.spotify_track, track.track_title, album.album_name, album.album_date, artist.artist_name FROM track INNER JOIN album ON track.album_id = album.album_id INNER JOIN artist ON track.artist_id = artist.artist_id WHERE artist.artist_name= '$artist'";
$res1 = $dbConn->query($sql) 
or die ('Problem with query: ' . $dbConn->error); 

if(mysqli_num_rows($res1)>0){ 
$row=$res1->fetch_assoc();
echo"<p id = 'h3col' align = 'center'>Thumbnail of the searched Artist - </p>";
echo"<div align = 'center'><img id = 'c' src='/twa/thumbs/artists/".$row['thumbnail']."' width='130' height='130'></div>";



echo "<table border = '1' align = 'center'>
<tr>
	<th>Album</th>
	<th>Artist</th>
	<th>Track</th>
	<th>Date</th>
	<th>Play</th>
	
</tr>";

while($row=$res1->fetch_assoc()){ 

echo"<tr>";
echo"<td>".$row['album_name']."</td>";
echo"<td>".$row['artist_name']."</td>";
echo"<td>".$row['track_title']."</td>";
echo"<td>".$row['album_date']."</td>";
echo"<td><iframe src='https://open.spotify.com/embed/track/".$row['spotify_track']."' width='300' height='380' frameborder='0' allowtransparency='true' allow='encrypted- media' ></iframe></td>";
echo"</tr>";
}
echo"</table>";
}	
}


if(isset($_GET['playlist_id'])) {
$playlist_id= $_GET['playlist_id'];

$qry="SELECT track.track_title, track.spotify_track FROM track
INNER JOIN playlist ON track.track_id = playlist.track_id
INNER JOIN memberplaylist ON playlist.playlist_id = memberplaylist.playlist_id
INNER JOIN membership on memberplaylist.member_id = membership.member_id
WHERE memberplaylist.playlist_id = '$playlist_id'";
$resu = $dbConn->query($qry)
or die ('Problem with query: ' . $dbConn->error); 

if(mysqli_num_rows($resu)>0){ 

echo "<table border = '1' align='center'>
<tr>
	<th>Track</th>
	<th>Spotify</th>
</tr>";
while($row=$resu->fetch_assoc()){ 

echo"<tr>";
echo"<td>".$row['track_title']."</td>"; 

echo"<td><iframe src='https://open.spotify.com/embed/track/".$row['spotify_track']."' width='300' height='380' frameborder='0' allowtransparency='true' allow='encrypted- media' ></iframe></td>";

echo"</tr>";
}
echo"</table>";
}	
}


?>
</body>
</html>