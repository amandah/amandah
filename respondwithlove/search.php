
<?php
	include 'head.php';

	if ($_POST['all']!=null) $all = true;
	else $all = false;

	$tbl_name="Animals"; // Table name 

	$locId = getLocId($userId);
	$city = getCity($locId);
	$state = getState($locId);
	$query="SELECT * FROM $tbl_name WHERE animalStatus='c'";

	
	$result = mysql_query($query) or die(mysql_error());


	$title = "Showing all animals in $city, $state";

	include 'header.php';
	
	echo '<ul data-role="listview"> 
			<li id="list" data-role="list-divider" data-divider-theme="a">
				'.$title.'
			</li>
		</ul>';
					
	echo "<div data-role=\"content\">
			<div class=\"content-primary\">
				<ul data-role=\"listview\" style=\"margin-top: 10;\" data-filter=\"true\" data-filter-placeholder=\"Search by Keyword or #\" data-inset=\"true\">";
	
	
	while($row = mysql_fetch_array($result)){
	
		$keywords = $row['id'].' '.$row['user_id'].' '. $row['type'].' '. $row['breed'].' '. $row['gender'].' '. $row['color'].' '. $row['description'];
		$id = $row['id'];
		echo "<li data-filtertext=\"$keywords\"><a href=\"animal.php?page=1&id=$id\" rel=\"external\" >";
		echo '<p>'.$row['id']. ' - '. $row['user_id']. ' - '. $row['type']. ' - '. $row['breed']. ' - '. $row['gender']. ' - '. $row['color']. ' - '. $row['description'];
		echo "</p></a></li>";
	}
	
	echo '		</ul>
			</div>
		</div>';
	
	include 'footer.php'
	


?>

</body>
</html>
