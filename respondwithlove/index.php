<?php 
	$errorMsg = "";
	
	// check if user is logged in
	$token = null;
	if (!empty($_COOKIE)) {
		$token = $_COOKIE['token'];
		$userId = $_COOKIE['userId'];
	}
	if ($userId>0){
		include 'config.php';
		$expired = '0';
		$sql="SELECT * FROM Users WHERE id='$userId' AND token='$token'";
		$result=mysql_query($sql);
		// Mysql_num_row is counting table row
		$count=mysql_num_rows($result);
		if($count==1){
			header("Location: menu.php"); // redirect to menu if user is already logged in
		}
		else {
			$errorMsg = "<p><i>Sorry, You have been banned from logging into the system.</i></p>";
		}
	}
	if (!empty($_GET)) $error = $_GET['error'];
	else $error = null;
	if ($error !== null){
		$errorMsg = "<p><i>Invalid username and/or password. Please try again</i></p>";
	}
	
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>
			Respond with Love - Animal Database
        </title>
		<link rel="stylesheet" href="http://code.jquery.com/mobile/1.1.0/jquery.mobile-1.1.0.min.css" />
		
        <script src="js/jquery.min.js"> </script>
        <script src="js/jquery.mobile-1.1.0.min.js"> </script>
		<script>
			$(document).bind("mobileinit",function() {
				$.mobile.ajaxEnabled = false;
			});
			$(function() {
				$( "#dialog" ).dialog();
				
			// hides the x button from the dialog
			$('a[data-icon=delete]').hide();
			});
		
		</script>
		<!-- CSS STYLE -->
		<style type="text/css">
        	
        	
        	a:link {
        		text-decoration:none; 
				color:white;
        	}
        	.ui-body-c .ui-link { /*Changes Link color*/
        		color:white;
        	}
        	

        </style>
		<!-- /CSS STYLE -->
		
    </head>
    <body>
		
		  
		  <div data-role="dialog" >
				
				<div data-role="header" data-theme="b">
					<h1>Respond with Love</h1>
					
				</div>
				
			<!-- CONTENT STARTS HERE -->
				<div data-role="content" data-theme="c">
					<form action="login.php" method="post">
						<fieldset>
							<div style=" text-align:center;" >
								<img src="logo.gif">
							</div>
							<div data-role="fieldcontain">
								<label for="name"><b>Username:</b></label>
								<input type="text" name="username" id="name" value="" required="required" />
							</div>
			
							<div data-role="fieldcontain">
								<label for="name"><b>Password:</b></label>
								<input type="password" name="password" id="pass" value="" required="required" />
							</div>
							<div align="center" >
								<input type="submit" value="Login" data-inline="true" data-theme="b" />
							</div>
							<?php echo $errorMsg; ?>
						</fieldset>
					</form>
				</div>
				<footer data-theme="d" data-role="footer">
				   <h3>
                    <a href="http://www.respondwithlove.org">
                    	RespondWithLove.org
                    </a>
                </h3> 	
				</footer>
			<!--/CONTENT-->
			</div>
			
          <!-- end of Home Page -->
          
          
    </body>
</html>
			

			
