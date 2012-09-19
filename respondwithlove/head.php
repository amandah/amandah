<?php 
include 'config.php';


$sql="SELECT * FROM Users WHERE id='$userId'";
$result = mysql_query($sql) or die(mysql_error());


$count=mysql_num_rows($result);

if($count==1){
	// Retreive user info 
	$results = mysql_fetch_array($result, MYSQL_ASSOC);
	$true_token = $results['token'];
	$locId = $results['address_id'];
	$username = $results['username'];

	// redirect if tokens don't match enables users to be forcably logged out
	if (strcmp($token,$true_token)!=0) header("Location: logout.php"); 
	else {
		$userCity = getCity($locId);
		$userState = getState($locId);
	}
}
else {
	header("Location: .?2");
}

	
/*
// http://stackoverflow.com/questions/637278/what-is-the-best-way-to-generate-a-random-key-within-php
// Generate a random key from /dev/random
function get_key($bit_length = 128){
    $fp = @fopen('/dev/random','rb');
    if ($fp !== FALSE) {
        $key = substr(base64_encode(@fread($fp,($bit_length + 7) / 8)), 0, (($bit_length + 5) / 6)  - 2);
        @fclose($fp);
        return $key;
    }
    return null;
}
*/

/*
// http://wiki.jumba.com.au/wiki/PHP_Get_user_IP_Address
// get users's ip address 
function VisitorIP(){ 
    if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $TheIp=$_SERVER['HTTP_X_FORWARDED_FOR'];
    else $TheIp=$_SERVER['REMOTE_ADDR'];
 
    return trim($TheIp);
}
*/


?>