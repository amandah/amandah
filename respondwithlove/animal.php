<?php 

include 'head.php';



$id = $_GET['id'];
$page = $_GET['page'];

	$animalCity = getCity($id);
	$animalState = getState($id);
	
$stockImages = array(
					'fcn'=>"images/femalecat2.png",
					'fcy'=>"images/femalecat.png", 
					'fdn'=>"images/femaledog2.png",
					'fdy'=>"images/femaledog.png",
					'mcn'=>"images/malecat2.png",
					'mcy'=>"images/malecat.png", 
					'mdn'=>"images/maledog2.png",
					'mdy'=>"images/maledog.png",
					'u'=>"images/question.png"
					);
					


$states = array('AL'=>"Alabama",
                'AK'=>"Alaska",  
                'AZ'=>"Arizona",  
                'AR'=>"Arkansas",  
                'CA'=>"California",  
                'CO'=>"Colorado",  
                'CT'=>"Connecticut",  
                'DE'=>"Delaware",  
                'DC'=>"District Of Columbia",  
                'FL'=>"Florida",  
                'GA'=>"Georgia",  
                'HI'=>"Hawaii",  
                'ID'=>"Idaho",  
                'IL'=>"Illinois",  
                'IN'=>"Indiana",  
                'IA'=>"Iowa",  
                'KS'=>"Kansas",  
                'KY'=>"Kentucky",  
                'LA'=>"Louisiana",  
                'ME'=>"Maine",  
                'MD'=>"Maryland",  
                'MA'=>"Massachusetts",  
                'MI'=>"Michigan",  
                'MN'=>"Minnesota",  
                'MS'=>"Mississippi",  
                'MO'=>"Missouri",  
                'MT'=>"Montana",
                'NE'=>"Nebraska",
                'NV'=>"Nevada",
                'NH'=>"New Hampshire",
                'NJ'=>"New Jersey",
                'NM'=>"New Mexico",
                'NY'=>"New York",
                'NC'=>"North Carolina",
                'ND'=>"North Dakota",
                'OH'=>"Ohio",  
                'OK'=>"Oklahoma",  
                'OR'=>"Oregon",  
                'PA'=>"Pennsylvania",  
                'RI'=>"Rhode Island",  
                'SC'=>"South Carolina",  
                'SD'=>"South Dakota",
                'TN'=>"Tennessee",  
                'TX'=>"Texas",  
                'UT'=>"Utah",  
                'VT'=>"Vermont",  
                'VA'=>"Virginia",  
                'WA'=>"Washington",  
                'WV'=>"West Virginia",  
                'WI'=>"Wisconsin",  
                'WY'=>"Wyoming");

if ($id === null) $id = 1; //default value


$tbl_name="Animals"; // Table name 
	
// To protect from MySQL injection
$breed = stripslashes($breed);
$color = stripslashes($color);
$distinctMarks = stripslashes($distinctMarks);
$breed = mysql_real_escape_string($breed);
$color = mysql_real_escape_string($color);
$distinctMarks = mysql_real_escape_string($distinctMarks);

// prepared statement
$sql="SELECT * FROM $tbl_name WHERE id='$id'";

$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
		
if($count==1){
	// Retreive user info 
	$results = mysql_fetch_array($result);
	$user_id = $results['user_id'];				// user who entered this animal into the database'
	$user = getUser($user_id);
	$addressId = $results ['address_id']; 		// current addresss
	$addressFoundId = $results['address_found_id']; // address where found
	$description = $results['description']; 		// description of the animal
	$type = $results['type']; 					// c = cat, d = dog, o = other
	
	$breed = $results['breed'];					
	$color = $results['color'];
	$gender = $results['gender'];				
	
	$spayOrNeutered = $results['spayOrNeutered']; // y = yes, n = no, u = unknown
	if ($spayOrNeutered === 't') $spayOrNeutered = "yes";
	else if ($spayOrNeutered === 'f') $spayOrNeutered = "no";
	else $spayOrNeutered = "unknown";
	
	$quarantine = $results['quarantine'];		// y = yes, n = no
	
	
	if ($quarantine === 'y') $quarantine = "yes";
	else $quarantine = "no";
	
	$ownerStatus = $results['ownerStatus'];		// k = known, u = unknown, d = deceased
	if ($ownerStatus === 'k') $ownerStatus = "known";
	else if ($ownerStatus === 'u') $ownerStatus = "unknown";
	else $ownerStatus = "deceased";
	
	$animalStatus = $results['animalStatus'];  // DEFAULT 'c' # c = currently being housed, r = recovered by owner, t = turned over to animal control, d = deceased
	$dateAccepted = $results['dateAccepted'];	// time the animals record is created
	$dateDischarged = $results['dateDischarged'];	// time the animal was released from Respond with Love custody
	$category1 = $results['category1']; 			// cat 1-4 are for future use
	$category2 = $results['category2']; 			// cat 1-4 are for future use
	$category3 = $results['category3']; 			// cat 1-4 are for future use
	$category4 = $results['category4']; 			// cat 1-4 are for future use
	$age = $results['age'];
	$cageNumber	= $results['cageNumber'];
	$size = $results['size'];
	$name = $results['name'];
}



if ($page == 5) {
	// get notes
	$sql="SELECT * FROM Notes WHERE animal_id='$id'"; 

	$result = mysql_query($sql);
	$notes = array();
	$dates = array();
	$userIds = array();
	$users = array();
	$x = 0;
	while($row = mysql_fetch_array($result)){
		$notes[$x] = $row['note'];
		$dates[$x] = $row['date'];
		$userIds[$x++] = $row['user_id'];
	}
	$x = 0;
	foreach ($userIds as $u_id){
		// get user who entered animal
		$users[$x++] = getUser($u_id);
	}
}

if ($page == 4 || $page == 1) {
	// get pictures
	$sql="SELECT * FROM Photos WHERE animal_id='$id'"; 

	$result = mysql_query($sql);
	$pics = array();
	$desc = array();
	$x = 0;
	while($row = mysql_fetch_array($result)){
		$pics[$x] = $row['link'];
		$desc[$x++] = $row['description'];
		//$dates[$x++] = strtotime( $mysqldate );
	}
}

mysql_close($link);


if ($page == 1) {

	$pageId= "info";
	
	include 'header.php';
	echo '
		
				<div data-role="navbar" data-iconpos="top" >
					<ul>
						<li><a href="animal.php?id='.$id.'&page=1" rel="external" data-role="button" data-icon="info">Edit Info</a></li>
						<li><a href="animal.php?id='.$id.'&page=2" rel="external" data-role="button" data-icon="home" data-theme="b">Owner</a></li>
						<li><a href="animal.php?id='.$id.'&page=3" rel="external" data-role="button" data-icon="plus" data-theme="b">Status</a></li>
						<li><a href="animal.php?id='.$id.'&page=4" rel="external" data-role="button" data-icon="star" data-theme="b">Pictures</a></li>
						<li><a href="animal.php?id='.$id.'&page=5" rel="external" data-role="button" data-icon="check" data-theme="b">Notes</a></li>
					</ul>
				</div> 
			';
	
	$image_url = $pics[0];
	if (empty($image_url)) {
		$key = substr($gender, 0, 1).substr($type, 0, 1).substr($quarantine, 0, 1); 
		$image_url = $stockImages[$key];
		if (empty($image_url)) $image_url =  $stockImages["u"];
	}
	echo '<ul data-role="listview">
				
			<li><a href="'.$image_url.'">
						<img src="'.$image_url.'" align="right" >
				<h3>'.$color.' '.$breed.' '.$gender.' '.$type.'</h3>
				<p>Animal Record #'.$id.'</p>
				</a>
			</li>';
				
							
				echo '<li>Record Created By: '.$user.'</li>';
				echo '<li>Quarantined: '.$quarantine.'</li>';
				echo '<li>'.$gender.' '.$type.'</li>';
				echo '<li>Color: '.$color.'</li>';
				echo '<li>Breed: '.$breed.'</li>';
				echo '<li>Spayed/Neutered: '.$spayOrNeutered.'</li>';
				echo '<li>Distinct Marks: '.$description.'</li>';
				echo '<li>Approx. Age: '.$age.'</li>';
	
	
				
	
} else if ($page == 2) {		
		
	$pageId= "owner";
	
	include 'header.php';
		
	echo '

		<div data-role="navbar" data-iconpos="top" >
			<ul>
				<li><a href="animal.php?id='.$id.'&page=1" rel="external" data-role="button" data-icon="info" data-theme="b">Edit Info</a></li>
				<li><a href="animal.php?id='.$id.'&page=2" rel="external" data-role="button" data-icon="home" >Owner</a></li>
				<li><a href="animal.php?id='.$id.'&page=3" rel="external" data-role="button" data-icon="plus" data-theme="b">Status</a></li>
				<li><a href="animal.php?id='.$id.'&page=4" rel="external" data-role="button" data-icon="star" data-theme="b">Pictures</a></li>
				<li><a href="animal.php?id='.$id.'&page=5" rel="external" data-role="button" data-icon="check" data-theme="b">Notes</a></li>
			</ul>
		</div>
		<ul data-role="listview">
			<li id="list" data-role="list-divider">
				Owner Info for Animal Record #'.$id.'
			</li>
		</ul>
		';
			
	
} else if ($page == 3) {
	
	$pageId= "status";
	
	include 'header.php';
	//c = currently being housed, r = recovered by owner, t = turned over to animal control, d = deceased
	$status = array('c'=>"Currently Being Housed", 'r'=>"Recovered by Owner", 't'=>"Turned over to Animal Control", 'd'=>"Deceased", 'o'=>"Other");

	
	echo '
	
		<div data-role="navbar" data-iconpos="top" >
			<ul>
				<li><a href="animal.php?id='.$id.'&page=1" rel="external" data-role="button" data-icon="info" data-theme="b">Edit Info</a></li>
				<li><a href="animal.php?id='.$id.'&page=2" rel="external" data-role="button" data-icon="home" data-theme="b">Owner</a></li>
				<li><a href="animal.php?id='.$id.'&page=3" rel="external" data-role="button" data-icon="plus" >Status</a></li>
				<li><a href="animal.php?id='.$id.'&page=4" rel="external" data-role="button" data-icon="star" data-theme="b">Pictures</a></li>
				<li><a href="animal.php?id='.$id.'&page=5" rel="external" data-role="button" data-icon="check" data-theme="b">Notes</a></li>
			</ul>
		</div>
		<ul data-role="listview">
			<li id="list" data-role="list-divider">
				Animal Record #'.$id.'
			</li>
		</ul>
		<div data-role="content" data-theme="c">
			<form  data-ajax="false" action="status.php" method="get">
				<p>'.$errorMsg.'</p>
				<fieldset>
					<div data-role="fieldcontain">
						<label for="status" class="select"><b>Animal Status:</b></label>
						<select name="status" id="status">';
							foreach ($status as $stat) {
								echo '<option value="'.$stat.'"';
								if (strcmp($animalStatus, $stat)==0) echo 'selected="selected"';
								echo '>'.$stat.'</option>';
							}
							echo '
						</select>
					</div>
				
					<div data-role="fieldcontain">
						<label for="city"><b>City:</b></label>
						<input type="text" name="city" id="city" value="'.$animalCity.'" required="required" />
					</div>
					
					<div data-role="fieldcontain">
						<label for="state" class="select"><b>State:</b></label>
						<select name="state" id="state">
							'; 
								foreach ($states as $state) {
									echo '<option value="'.$state.'"';
									if (strcmp($animalState, $state)==0) echo 'selected="selected"';
										echo '>'.$state.'</option>';
									}
							echo '
						</select>
					</div>
					
					
			
					<div align="center" >
						<input type="submit" value="Update Animal Status" data-inline="true" data-theme="b" />
					</div>
							
				</fieldset>
			</form>
		</div>
		
		
		';					
							
} else if ($page == 4) {
			
	$pageId= "pictures";
	
	include 'header.php';

	echo '
	
		<div data-role="navbar" data-iconpos="top" >
			<ul>
				<li><a href="animal.php?id='.$id.'&page=1" rel="external" data-role="button" data-icon="info" data-theme="b">Edit Info</a></li>
				<li><a href="animal.php?id='.$id.'&page=2" rel="external" data-role="button" data-icon="home" data-theme="b">Owner</a></li>
				<li><a href="animal.php?id='.$id.'&page=3" rel="external" data-role="button" data-icon="plus" data-theme="b">Status</a></li>
				<li><a href="animal.php?id='.$id.'&page=4" rel="external" data-role="button" data-icon="star" >Pictures</a></li>
				<li><a href="animal.php?id='.$id.'&page=5" rel="external" data-role="button" data-icon="check" data-theme="b">Notes</a></li>
			</ul>
		</div>	
		<ul data-role="listview">
			<li id="list" data-role="list-divider">
				Animal Record #'.$id.'
			</li>
		</ul>
		'; 
		echo '
		<div class="container">
			<div data-role="collapsible" data-collapsed="true">
				<h3>Click Here to See Images</h3>
				<!-- start grid row --->
				<div class="row"> ';
				
					$y = 0;
					foreach ($pics as $pic){
						echo '<div class="span4"><img src="'.$pic.'" width="100%" ></div>';
						echo '<div class="span4"><h3>'.$desc[$y++].'</h3></div>';
					}
					if ($y == 0) echo '<div class="span4">No images</div>';
echo '					
				</div>
			</div>
		</div>';
		
		
		
		
		
		echo '
		<form action="newphoto.php" method="get">
			<fieldset>
				<div data-role="fieldcontain">
					<label for="link">&nbsp;&nbsp;&nbsp;Image Link:</label>
					<input type="text" name="link" id="link" value=""  />
				</div>
				<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
					<label for="textarea" class="ui-input-text">&nbsp;&nbsp;&nbsp;Description:</label>
					<textarea cols="40" rows="8" name="description" id="description" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset"></textarea>
				</div>
				
				<input type="hidden" name="id" value="'.$id.'">
				<div align="center" >
					<input type="submit" value="Add Picture" data-inline="true" data-theme="b" />
				</div>
			<fieldset>
		</form>
		';
		
		
		
		
		
		
	 
} else {			
	
	$pageId= "notes";
	
	include 'header.php';
	
	echo '
	
		<div data-role="navbar" data-iconpos="top" >
			<ul>
				<li><a href="animal.php?id='.$id.'&page=1" rel="external" data-role="button" data-icon="info" data-theme="b">Edit Info</a></li>
				<li><a href="animal.php?id='.$id.'&page=2" rel="external" data-role="button" data-icon="home" data-theme="b">Owner</a></li>
				<li><a href="animal.php?id='.$id.'&page=3" rel="external" data-role="button" data-icon="plus" data-theme="b">Status</a></li>
				<li><a href="animal.php?id='.$id.'&page=4" rel="external" data-role="button" data-icon="star" data-theme="b">Pictures</a></li>
				<li><a href="animal.php?id='.$id.'&page=5" rel="external" data-role="button" data-icon="check" >Notes</a></li>
			</ul>
		</div>	
		<ul data-role="listview">
			<li id="list" data-role="list-divider">
				Animal Record #'.$id.'
			</li>
		</ul>
		
		
		<ul data-role="listview">';
		
			$y = 0;
			foreach ($notes as $note){
				echo '<li>'.date($dates[$y]).' - '.$note.' - '.$users[$y].'</li>';
				$y++;
			}
			if ($y==0) echo '<li>Their are no notes on this animal.</li>';
		
		echo '
		</ul>
		<form action="newnote.php" method="get">
			<fieldset>
				<div data-role="fieldcontain" class="ui-field-contain ui-body ui-br">
					<label for="textarea" class="ui-input-text">&nbsp;&nbsp;&nbsp;New Note:</label>
					<textarea cols="40" rows="8" name="note" id="note" class="ui-input-text ui-body-c ui-corner-all ui-shadow-inset"></textarea>
				</div>
				<input type="hidden" name="id" value="'.$id.'">
				<div align="center" >
					<input type="submit" value="Add Note" data-inline="true" data-theme="b" />
				</div>
			<fieldset>
		</form>
		';
}
		
		
// footer in same position for all
include 'footer.php'; 

echo '

		
	</body>
	
</html>'; 

?>
