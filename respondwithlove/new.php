<?php 
		include 'head.php';
		$pageId = "index";
		include 'header.php'; 
?>
		 
		 <!-- CONTENT STARTS HERE -->

			<div class="content">
				<form action="newanimal.php" rel="external" method="get">	
				
					<ul data-role="listview"> 
						<li id="list" data-role="list-divider" data-divider-theme="a">
							Enter New Animal
						</li>
					</ul>
					<div style="padding:10px; text-align:center;">
						<div data-role="fieldcontain" data-mini="true">
							<fieldset data-role="controlgroup" data-type="horizontal" required="required">
								<legend>Animal Type:</legend>
								<input type="radio" name="type" id="dog" value="dog"/>
								<label for="dog">Dog</label>
								<input type="radio" name="type" id="cat" value="cat" />
								<label for="cat">Cat</label>
								<input type="radio" name="type" id="other" value="other" />
								<label for="other">Other</label>
						
							</fieldset>
						</div>
						<div data-role="fieldcontain" data-mini="true">
							<fieldset data-role="controlgroup" data-type="horizontal" required="required">
								<legend>Gender:</legend>
								<input type="radio" name="gender" id="female" value="female"/>
								<label for="female">Female</label>
								<input type="radio" name="gender" id="male" value="male" />
								<label for="male">Male</label>
								<input type="radio" name="gender" id="unknown" value="unknown" />
								<label for="unknown">???</label>
							</fieldset>
						</div>
				
						<div data-role="fieldcontain" data-mini="true">
							<fieldset data-role="controlgroup" data-mini="true">
								<label for="breed">Breed:</label>
								<input id="breed" placeholder="" value="" type="text" name="breed" data-inline="true"/>
							</fieldset>
						</div>
				
						<div data-role="fieldcontain" data-mini="true">
							<fieldset data-role="controlgroup" data-mini="true">
								<label for="color">Color(s):</label>
								<input id="color" placeholder="" value="" type="text" name="color" data-inline="true" />
							</fieldset>
						</div>
					
						<div data-role="fieldcontain">
							<label for="age">Approx. Age (years):</label>
							<input type="range" name="age" id="age" value="0" min="0" max="25" step="1" data-highlight="true" data-inline="true" />
						</div>

						<div data-role="fieldcontain" data-mini="true">
							<fieldset data-role="controlgroup" data-mini="true">
								<label for="distinctMarks">Description of any Distinct Markings</label>
								<input id="distinctMarks" placeholder="" value="" type="text" name="distinctMarks" />
							</fieldset>
						</div>

						<div data-role="fieldcontain" data-mini="true">
							<fieldset data-role="controlgroup" data-type="horizontal">
								<legend>Size (in comparison to species):</legend>
								<input type="radio" name="size" id="small" value="small"/>
								<label for="small">Small</label>
								<input type="radio" name="size" id="medium" value="medium" />
								<label for="medium">Medium</label>
								<input type="radio" name="size" id="large" value="large" />
								<label for="large">Large</label>
								<input type="radio" name="size" id="extra" value="extra" />
								<label for="extra">XL</label>
						
							</fieldset>
						</div>

						<div data-role="fieldcontain">
							<fieldset data-role="controlgroup" data-type="horizontal" required="required">
								<legend>Spayed or Neutered:</legend>
								
								<input type="radio" name="spayNeut" id="yes" value="true" />
								<label for="yes">Yes</label>
								<input type="radio" name="spayNeut" id="no" value="false"/>
								<label for="no">No</label>
			         	
							</fieldset>
						</div>
				
			
						<div data-role="fieldcontain">
							<fieldset data-role="controlgroup" data-type="horizontal" required="required">
								<legend>Quarentined:</legend>
								
								<input type="radio" name="quarentine" id="yes" value="true" />
								<label for="yes">Yes</label>
								<input type="radio" name="quarentine" id="no" value="false"/>
								<label for="no">No</label>
			         	
							</fieldset>
						</div>
						
						<div data-role="fieldcontain" data-mini="true">
							<fieldset data-role="controlgroup" data-type="horizontal" required="required">
								<legend>Owner Status:</legend>
								<input type="radio" name="type" id="known" value="known"/>
								<label for="known">Known</label>
								<input type="radio" name="type" id="unknown" value="unknown" />
								<label for="unknown">Unknown</label>
								<input type="radio" name="type" id="deceased" value="deceased" />
								<label for="deceased">Deceased</label>
						
							</fieldset>
						</div>
				
					
						<fieldset class="ui-grid-a">
							<div class="ui-block-a"><a href="menu.php"><button type="cancel" data-theme="c" data-icon="delete">Cancel</button></a></div>
							<div class="ui-block-b"><button type="submit" data-theme="b" data-icon="check">Submit</button></div>
						</fieldset>
						
					</div>
				</form>

			</div>
		 
			<?php include 'footer.php'; ?>
          
    </body>
</html>
			

			
