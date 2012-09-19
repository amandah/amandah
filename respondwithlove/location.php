<?php 
	include 'head.php'; 
	$pageId = "location";
	include 'header.php'; 
	
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
	
	// store city and state
	$city = $_GET['city'];
	$state = $_GET['state'];
	
	if (strlen($city)>0 && strlen($state)>0) {
		
		$tbl_name="Addresses"; // Table name 
	
		// To protect from MySQL injection
		$city = stripslashes($city);
		$state = stripslashes($state);
		$city = mysql_real_escape_string($city);
		$state = mysql_real_escape_string($state);

		$sql="SELECT * FROM $tbl_name WHERE city='$city' and state='$state'";
		$result=mysql_query($sql);

		// Mysql_num_row is counting table row
		$count=mysql_num_rows($result);


		
		if($count==1){
			// location is already in database
			$results = mysql_fetch_array($result);
	
			$locationId = $results['id'];
		}
		else {
			// location needs to be added to the database
			$sql="INSERT INTO $tbl_name (city, state) VALUES 
						('$city', '$state')";
			if (!mysql_query($sql,$link))
			{
				die('Error: ' . mysql_error());
			}
			$locationId = mysql_insert_id();
		}
		// update new locationId in User database
		$tbl_name="Users";
		// prepared statement
		$sql="UPDATE $tbl_name SET address_id='$locationId' WHERE id='$userId'";
				
		if (!mysql_query($sql,$link)){
			die('Error: ' . mysql_error());
		}
		$errorMsg = "Location Changed Sucessfully";
		$userCity = $city;
		$userState = $state;
	}

?>
			
			<!-- CONTENT STARTS HERE -->
					<div data-role="navbar" data-iconpos="top" >
						<ul>
							<li><a href="password.php" rel="external" data-role="button" data-icon="grid" data-theme="b">Change</br>Password</a></li>
							<li><a href="location.php" rel="external" data-role="button" data-icon="home" >Update</br>Location</a></li>
							<li><a href="display.php" rel="external" data-role="button" data-icon="gear" data-theme="b">Display</br>Preferences</a></li>
							<li><a href="diary.php" rel="external" data-role="button" data-icon="star" data-theme="b">Make Diary</br>Entry</a></li>
							<li><a href="emergency.php" rel="external" data-role="button" data-icon="alert" data-theme="b">Emergency</br>Contact</a></li>
						</ul>
					</div>
					<ul data-role="listview">
						<li id="list" data-role="list-divider">
							Change Location
						</li>
					</ul>
				<div data-role="content" data-theme="c">
					<form  data-ajax="false" action="location.php" method="get">
					<?php echo '<p>'.$errorMsg.'</p>'; ?>
						<fieldset>
							<div data-role="fieldcontain">
								<label for="city"><b>City:</b></label>
								<input type="text" name="city" id="city" value="<?php echo $userCity; ?>" required="required" />
							</div>
							<div data-role="fieldcontain">
								<label for="state" class="select"><b>State:</b></label>
								<select name="state" id="state">
									<?php 
										foreach ($states as $state) {
											echo '<option value="'.$state.'"';
											if (strcmp($userState, $state)==0) echo 'selected="selected"';
											echo '>'.$state.'</option>';
										}
									?>
								</select>
							</div>
			
							<div align="center" >
								<input type="submit" value="Update Location" data-inline="true" data-theme="b" />
							</div>
							
						</fieldset>
					</form>
				</div>
			
			
			
			<?php 
			
			include 'footer.php'; 
			
			?>
          </body>
</html>
