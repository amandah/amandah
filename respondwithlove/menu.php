<?php 
	include 'head.php';
	$pageId = "index";
	include 'header.php'; 
?>
		  
		  
		    
			<!-- CONTENT STARTS HERE -->
			<div class="content">
				<ul data-role="listview"> <!--data-inset="true">-->
					<li id="firstlist" data-role="list-divider" data-divider-theme="a">
						 <?php 
							echo '<h2>Hello '.$username.'!</h2>'; 
						 ?>
						<h3><i>Please choose from the following</i></h3>
						
					</li>
  					<li>
  						<a href="new.php" rel="external" data-icon="plus">
  							Log New Animal
  						</a>
  					</li>
  					<li>
  						<a href="search.php?all=true" rel="external" data-icon="grid">
  							Browse Current Animals
  						</a>
  					</li>
				    <li>
				    	<a href="search.php" rel="external"  data-icon="search">
				    		Search for Animal
				    	</a>
				    </li>
					<li>
  						<a href="inventory.php" rel="external" data-icon="check">
  							Inventory
  						</a>
  					</li>
  					<li>
  						<a href="password.php" rel="external" data-icon="star">
  							User Options
  						</a>
  					</li>
					
				</ul>
			</div><!--/content-->
			<!--/CONTENT-->
			
			<?php include 'footer.php'; ?>
		
        <!-- end of Index Page -->
                    
    </body>
</html>
			

			
