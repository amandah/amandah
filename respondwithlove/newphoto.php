<?php

	require 'config.php';
	$link = $_GET['link'];
	$id = $_GET['id'];
	$description = $_GET['description'];
	
	
// To protect from MySQL injection
$link = stripslashes($link);
$link = mysql_real_escape_string($link);

// prepared statement
$sql="INSERT INTO Photos (animal_id, user_id, link, description) VALUES 
						('$id', '$userId', '$link', '$description')";

if (!mysql_query($sql)) die('Error: ' . mysql_error());

 
mysql_close();

header("Location: animal.php?page=4&id=$id");

?>