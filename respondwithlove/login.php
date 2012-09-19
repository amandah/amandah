<?php

include 'config.php'; // defines database constants and starts db connection


$tbl_name="Users"; // Table name 


// username and password sent from form 
$myusername=$_POST['username']; 
$mypassword=$_POST['password']; 

// To protect from MySQL injection
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$result = mysql_query($sql) or die(mysql_error());

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);


if($count==1){

	// Retreive user info 
	$results = mysql_fetch_array($result);
	
	// make sure user is not banned from system
	$banned = $results['banned'];
	if ($banned) header("Location: index.php?error=true");
	
	
	$userId = $results['id'];
	$theme = $results['theme'];
	//$locId = $results['address_id'];
	
	/*// Check if unexpired token exists for this userId in Token database, if so, expire it this prevents multiple logins
	$sql="UPDATE Tokens SET expired='1' WHERE userId='$userId'";
	mysql_query($sql);
	*/
	// Get a new token string
	$newToken = rand_char();
	
	/*// Store token in the Token database with userId
	$sql="INSERT INTO Tokens (token, userId) VALUES 
						('$token', '$userId')";
	if (!mysql_query($sql,$link)){
		die('Error: ' . mysql_error());
	}
	$tokenId = mysql_insert_id();
	*/
	// Store token in User table for User with userId=userId
	$sql="UPDATE $tbl_name SET token='$token' WHERE id='$userId'";
				
	if (!mysql_query($sql,$link)){
		die('Error: ' . mysql_error());
	}
	/*
	
	// get location
	$tbl_name="Addresses"; // Table name

	$sql="SELECT * FROM $tbl_name WHERE id='$locId'";
	$result=mysql_query($sql);

	// Retreive user info 
	$results = mysql_fetch_array($result);
	$userCity = $results['city'];
	$userState = $results['state'];*/

	setcookie("token", $token);
	setcookie("userId", $userId);
	setcookie("theme", $theme);

	mysql_close($link);

	
	// Redirect to file "menu.php"
	header("Location: menu.php");
	
}
else {
	mysql_close($link);
	// Redirect back to index with error=true
	header("Location: .?error=true");
}

// creates 32 bit random value string used for token
function rand_char($length = 32) {
  $random = '';
  for ($i = 0; $i < $length; $i++) {
    $random .= chr(mt_rand(33, 126));
  }
  return $random;
}

?>
