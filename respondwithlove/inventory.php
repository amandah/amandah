<?php 
include 'head.php'; 
include 'header.php'; 
?>


			<div class="content">
				<ul data-role="listview"> 
					<li id="firstlist" data-role="list-divider" data-divider-theme="a">
						Inventory Menu
					</li>
					<li>
						<a href="createinventory.php" rel="external" data-icon="plus">
  							Create New Inventory Record
  						</a>
					</li>
					<li>
						<a href="editinventory.php" rel="external" data-icon="plus">
  							View/Edit Current Inventory
  						</a>
					</li>
					<li>
						<a href="requestsupplies.php" rel="external" data-icon="plus">
  							Request Additional Supplies
  						</a>
					</li>
					<li>
						<a href="inventoryloss.php" rel="external" data-icon="plus">
  							Log Inventory Loss
  						</a>
					</li>
					<li>
						<a href="consumption.php" rel="external" data-icon="plus">
  							Estimate Inventory Consumption Date
  						</a>
					</li>
					<li>
						<a href="statistics.php" rel="external" data-icon="plus">
  							Inventory Usage Statstics
  						</a>
					</li>
				</ul>
			</div>


			<?php include 'footer.php'; ?>
			
          
    </body>
</html>
