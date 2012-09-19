
<?php

	include 'head.php';

	$tbl_name="Animals"; // Table name 

	$locId = $_COOKIE['locId'];
	$city = $_COOKIE['city'];
	$state = $_COOKIE['state'];
	$query="SELECT * FROM $tbl_name WHERE animalStatus='c'";

	
	$result = mysql_query($query) or die(mysql_error());

	$pageId = "index";
	include 'header.php';
	
	echo "<h3>Showing all animals in $city, $state</h3>";
	
	echo "<div class=\"content-primary\"><ul data-role=\"listview\" data-filter=\"true\" data-filter-placeholder=\"Search\" data-inset=\"false\">";
	
	
	while($row = mysql_fetch_array($result)){
	
		$keywords = $row['id'].' '.$row['user_id'].' '. $row['type'].' '. $row['breed'].' '. $row['gender'].' '. $row['color'].' '. $row['description'];
	
		echo "<li data-filtertext=\"$keywords\"><a href=\"animal.php?$id\" rel=\"external\" >";
		echo '<p>'.$row['id']. ' - '. $row['user_id']. ' - '. $row['type']. ' - '. $row['breed']. ' - '. $row['gender']. ' - '. $row['color']. ' - '. $row['description'];
		echo "</p></a></li>";
	}
	echo '</table>';
	
	echo '</ul></div>';
	
	include 'footer.php'
	
	
?>

</body>
</html>