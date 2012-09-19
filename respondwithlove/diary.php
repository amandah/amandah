<?php 

	include 'config.php';
	
	
	// get users's notes
	$sql="SELECT * FROM Notes WHERE user_id='$userId'"; 

	$result = mysql_query($sql);
	$notes = array();
	$dates = array();
	$animalIds = array();
	$users = array();
	$x = 0;
	while($row = mysql_fetch_array($result)){
		$notes[$x] = $row['note'];
		$dates[$x] = $row['date'];
		$animalIds[$x] = $row['animal_id'];
		if (empty($animalIds[$x])) $animalIds[$x] = -1;
		$x++;
	}
	
	$pageId= "diary";
	
	include 'header.php';
	
	echo '
	
		<div data-role="navbar" data-iconpos="top" >
			<ul>
				<li><a href="password.php" rel="external" data-role="button" data-icon="grid" data-theme="b">Change</br>Password</a></li>
				<li><a href="location.php" rel="external" data-role="button" data-icon="home" data-theme="b" >Update</br>Location</a></li>
				<li><a href="display.php" rel="external" data-role="button" data-icon="gear"  data-theme="b">Display</br>Preferences</a></li>
				<li><a href="diary.php" rel="external" data-role="button" data-icon="star">Make Diary</br>Entry</a></li>
				<li><a href="emergency.php" rel="external" data-role="button" data-icon="alert" data-theme="b">Emergency</br>Contact</a></li>
			</ul>
		</div>
		<ul data-role="listview">
			<li id="list" data-role="list-divider">
				Diary
			</li>
		</ul>
		
		
		<ul data-role="listview">';
		
			$y = 0;
			foreach ($notes as $note){
				echo '<li>';
				if ($animalIds[$y]>=0) echo '<a href="animals.php?id='.$animalIds[$y].'&page=1">';
				echo 'date($dates[$y]).' - '.$note.';
				if ($animalIds[$y]>=0) echo '</a>';
				echo '</li>';
				$y++;
			}
			if ($y==0) echo '<li>You have made no entries.</li>';
			
		$val = -1;
		
		echo '
		</ul>
		<form action="newnote.php?diary=true" method="get">
			<fieldset>
				<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
					<label for="textarea" class="ui-input-text">&nbsp;&nbsp;&nbsp;New Note:</label>
					<textarea cols="40" rows="8" name="note" id="note" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset"></textarea>
				</div>
				<input type="hidden" name="id" value="'.$val.'">
				<div align="center" >
					<input type="submit" value="Add Diary Entry" data-inline="true" data-theme="b" />
				</div>
			<fieldset>
		</form>
		';

		
		
// footer in same position for all
include 'footer.php'; 

echo '

		
	</body>
	
</html>'; 

?>