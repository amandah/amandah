<?php

	require 'config.php';
	$diary = $_GET['diary'];
	$note = $_GET['note'];
	if ($diary) {
		$animal_id = -1;
	}
	else{
		$animal_id = $_GET['id'];
	}
	
// To protect from MySQL injection
$note = stripslashes($note);
$note = mysql_real_escape_string($note);

// prepared statement
$sql="INSERT INTO Notes (animal_id, user_id, note) VALUES 
						('$animal_id', '$userId', '$note')";

if (!mysql_query($sql)) die('Error: ' . mysql_error());

 
mysql_close();

	if ($diary) header("Location: diary.php?new=true");
	else header("Location: animal.php?page=5&id=$id");

?>