<?php 
 
// Store form values from previous page
$type = $_GET['type'];
$gender = $_GET['gender'];
$breed = $_GET['breed'];
$age = $_GET['age'];
$color = $_GET['color'];
$spayNeut = $_GET['spayNeut'];
$quarantine = $_GET['quarantine'];
$distinctMarks = $_GET['distinctMarks'];

include 'config.php'; // defines database constants and starts db connection

$tbl_name="Animals"; // Table name 
	
// To protect from MySQL injection
$breed = stripslashes($breed);
$color = stripslashes($color);
$distinctMarks = stripslashes($distinctMarks);
$breed = mysql_real_escape_string($breed);
$color = mysql_real_escape_string($color);
$distinctMarks = mysql_real_escape_string($distinctMarks);

// prepared statement
$sql="INSERT INTO $tbl_name (user_id, description, type, breed, color, gender, spayOrNeutered, quarantine, age ) VALUES 
						('$userId', '$distinctMarks', '$type', '$breed', '$color', '$gender', '$spayNeut', '$quarentine', $age)";

if (!mysql_query($sql,$link))
  {
  die('Error: ' . mysql_error());
  }
$newId = mysql_insert_id();

// Redirect to animal page
header("Location: animal.php?page=1&id=$newId");


// get user who entered animal
$tbl_name="Users"; // Table name 
$sql="SELECT username FROM $tbl_name WHERE id='$userId'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
		
$username = "";
// If result matched $myusername and $mypassword, table row must be 1 row
if($count==1){
	// Retreive user info 
	$results = mysql_fetch_array($result);
	$username = $results['username'];
}

mysql_close($link);


?>
