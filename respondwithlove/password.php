<?php 
	include 'head.php'; 
	$pageId = "password";
	include 'header.php'; 
	
	// store passwords
	$pw1 = $_POST['pw1'];
	$pw2 = $_POST['pw2'];
	$pw3 = $_POST['pw3'];
	
	if (strlen($pw1)>0 && strlen($pw2)>0 && strlen($pw3)>0) {
		// two new passwords don't match
		if (strcmp($pw2, $pw3)!==0) $errorMsg = "Error: Confirmation Password does not match.";
		// new password = old password
		else if (strcmp($pw1,$pw2)===0) $errorMsg = "Error: Your new password equals your old password.";
		else {
			$tbl_name="Users"; // Table name 
	
			// To protect from MySQL injection
			$pw1 = stripslashes($pw1);
			$pw2 = stripslashes($pw2);
			$pw3 = stripslashes($pw3);
			$pw1 = mysql_real_escape_string($pw1);
			$pw2 = mysql_real_escape_string($pw2);
			$pw3 = mysql_real_escape_string($pw3);

			$sql="SELECT * FROM $tbl_name WHERE username='$username' and password='$pw1'";
			$result=mysql_query($sql);

			// Mysql_num_row is counting table row
			$count=mysql_num_rows($result);


			// If $count == 1, result matched $myusername and $pw1
			if($count==1){

				// prepared statement
				$sql="UPDATE $tbl_name SET password='$pw2' WHERE id='$userId'";
				
				if (!mysql_query($sql,$link)){
					die('Error: ' . mysql_error());
				}

				$errorMsg = "Password Changed Sucessfully";
			}
			else {
				$errorMsg = "Error invalid current password";
			}
		}
	}

			?>
			
			<!-- CONTENT STARTS HERE -->
					<div data-role="navbar" data-iconpos="top" >
						<ul>
							<li><a href="password.php" rel="external" data-role="button" data-icon="grid">Change</br>Password</a></li>
							<li><a href="location.php" rel="external" data-role="button" data-icon="home" data-theme="b">Update</br>Location</a></li>
							<li><a href="display.php" rel="external" data-role="button" data-icon="gear" data-theme="b">Display</br>Preferences</a></li>
							<li><a href="diary.php" rel="external" data-role="button" data-icon="star" data-theme="b">Make Diary</br>Entry</a></li>
							<li><a href="emergency.php" rel="external" data-role="button" data-icon="alert" data-theme="b">Emergency</br>Contact</a></li>
						</ul>
					</div>
					<ul data-role="listview">
						<li id="list" data-role="list-divider">
							Change Password
						</li>
					</ul>
				
				<div data-role="content" data-theme="c">
					
					<form  data-ajax="false" action="password.php" method="post">
					<?php echo '<p>'.$errorMsg.'</p>'; ?>
						<fieldset>
							<div data-role="fieldcontain">
								<label for="name"><b>Current Password:</b></label>
								<input type="password" name="pw1" id="name" value="" required="required" />
							</div>
							<div data-role="fieldcontain">
								<label for="name"><b>New Password:</b></label>
								<input type="password" name="pw2" id="name" value="" required="required" />
							</div>
			
							<div data-role="fieldcontain">
								<label for="name"><b>Confirm New Password:</b></label>
								<input type="password" name="pw3" id="pass" value="" required="required" />
							</div>
							<div align="center" >
								<input type="submit" value="Change Password" data-inline="true" data-theme="b" />
							</div>
							
						</fieldset>
					</form>
				</div>
			
			
			
			<?php 
			
			include 'footer.php'; 
			
			?>
          </body>
</html>
