<?php

// Store cookie info
$userId = $_COOKIE['userId'];
$token = $_COOKIE['token'];
$theme = $_COOKIE['theme'];

// database login info
$host="localhost"; // Host name 
$db_username="gameophi_falls"; // Mysql username 
$db_password="amandah"; // Mysql password 
$db_name="gameophi_senior"; // Database name 

// Connect to server and select database.
$link = mysql_connect("$host", "$db_username", "$db_password");
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db("$db_name")or die('Cannot select DB: ' . mysql_error());


/* FUNCTIONS */
function getUser($user_id){

	// get user who entered animal
	$tbl_name="Users"; // Table name 
	$sql="SELECT username FROM $tbl_name WHERE id='$user_id'";
	$result=mysql_query($sql);

	// Mysql_num_row is counting table row
	$count=mysql_num_rows($result);
		
	$user = "";
	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count==1){
		// Retreive user info 
		$results = mysql_fetch_array($result);
		$user = $results['username'];
	}
	return $user;
}
function getCity($locId){
	// get location information
	$sql="SELECT city FROM Addresses WHERE id='$locId'";
	$result = mysql_query($sql) or die(mysql_error());
	$count=mysql_num_rows($result);
	$userCity = "";		
	if ($count>=1){
		// Retreive user info 
		$result_set = mysql_fetch_array($result, MYSQL_ASSOC);
		$userCity = $result_set['city'];
	}
	return $userCity;
}
function getState($locId){
	// get location information
	$sql="SELECT state FROM Addresses WHERE id='$locId'";
	$result = mysql_query($sql) or die(mysql_error());
	$count=mysql_num_rows($result);
	$userState = "";		
	if ($count>=1){
		// Retreive user info 
		$result_set = mysql_fetch_array($result, MYSQL_ASSOC);
		$userState = $result_set['state'];
	}
	return $userState;
}
function getLocId($id){
	// get location information
	$sql="SELECT address_id FROM Users WHERE id='$id'";
	$result = mysql_query($sql) or die(mysql_error());
	$count=mysql_num_rows($result);
	$addressId = 0;		
	if ($count>=1){
		// Retreive user info 
		$result_set = mysql_fetch_array($result, MYSQL_ASSOC);
		$addressId = $result_set['address_id'];
	}
	return $addressId;
}

?>
