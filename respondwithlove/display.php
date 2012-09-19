<?php 
	 
	
	$themes = array('a'=>"Black",
                'b'=>"Blue",  
                'c'=>"Light Gray",  
                'd'=>"Dark Gray",  
                'e'=>"Yellow",  
                'f'=>"White");
				
	// store city and state
	$color = $_GET['color'];
	include 'head.php';
	
	if (!empty($color)) {
		
		$tbl_name="Users"; // Table name 
	
		// update theme color
		$sql="UPDATE $tbl_name SET theme='$color' WHERE id='$userId'";
				
		if (!mysql_query($sql,$link)){
			die('Error: ' . mysql_error());
		}
		
		setcookie("theme", $color);
		$theme = $color;
		$errorMsg = "Theme Changed Sucessfully";
	}
	
	$pageId = "display";
	include 'header.php';
        
	?>
			
			<!-- CONTENT STARTS HERE -->
					<div data-role="navbar" data-iconpos="top" >
						<ul>
							<li><a href="password.php" rel="external" data-role="button" data-icon="grid" data-theme="b">Change</br>Password</a></li>
							<li><a href="location.php" rel="external" data-role="button" data-icon="home" data-theme="b" >Update</br>Location</a></li>
							<li><a href="display.php" rel="external" data-role="button" data-icon="gear" >Display</br>Preferences</a></li>
							<li><a href="diary.php" rel="external" data-role="button" data-icon="star" data-theme="b">Make Diary</br>Entry</a></li>
							<li><a href="emergency.php" rel="external" data-role="button" data-icon="alert" data-theme="b">Emergency</br>Contact</a></li>
						</ul>
					</div>
					<ul data-role="listview">
						<li id="list" data-role="list-divider">
							Current Theme: <?php echo $themes[$theme]; ?>
						</li>
					</ul>
				<div data-role="content" data-theme="c">
					<form  data-ajax="false" action="display.php" method="get">
					<?php echo '<p>'.$errorMsg.'</p>'; ?>
						<fieldset>
							
							<div data-role="fieldcontain">
								<label for="color" class="select"><b>Theme:</b></label>
								<select name="color" id="color">
									<?php 
										foreach ($themes as $key => $color) {
											echo '<option value="'.$key.'"';
											if (strcmp($theme, $key)==0) echo 'selected="selected"';
											echo '>'.$color.'</option>';
										}
									?>
								</select>
							</div>
			
							<div align="center" >
								<input type="submit" value="Change Theme" data-inline="true" data-theme="b" />
							</div>
							
						</fieldset>
					</form>
				</div>
			
			
			
			<?php 
			
			include 'footer.php'; 
			
			?>
          </body>
</html>

	