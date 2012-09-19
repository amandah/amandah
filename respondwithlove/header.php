<?php
	
	
echo '

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
		<style type="text/css">
        	#table
			{			
				table-layout: fixed;
			}
        	
        	a:link {
        		text-decoration:none; 
        	}
        	

        </style>
		<script type="application/javascript">
			$(document).bind("mobileinit",function() {
				$.mobile.ajaxEnabled = false;
			});
		
			$(document).ready(function(){
				// Add a click listener on the button to get the location data
				$(\'#getLocation\').click(function(){
					if (navigator.geolocation) {
						navigator.geolocation.getCurrentPosition(onSuccess, onError);
					} else {
						// If location is not supported on this platform, disable it
						$(\'#getLocation\').value = "Geolocation not supported";
						$(\'#getLocation\').unbind(\'click\');
					}		
				});
				
				
			});

			// create the geonames namespace for calling the API
			var geonames = {};
				geonames.baseURL = "http://ws.geonames.org/";
				geonames.method = "findNearbyWikipediaJSON";
				geonames.search = function(lat,lng){
				
				// get the data in JSON format from Geonames
				$.getJSON(geonames.baseURL + geonames.method + \'?formatted=true&lat=\' + lat + \'&lng=\' + lng + \'&style=full&radius=10&maxRows=25\',function(data){
					// Loop through each item in the result and add it to the DOM
					$.each(data.geonames, function() {
						$(\'<li></li>\')
						.hide()
						.append(\'<a href="http://\'+this.wikipediaUrl+\'"><h2>\'+this.title+\'</h2></a><br /><p>\'+ this.summary + \'</p><span class="ui-li-aside"><h5>\'+this.distance+\' (km)</h5></span>\')
						.appendTo(\'#wikiList\')
						.show();
					});
					// Once the data is added to the DOM, make the transition
					$.mobile.changePage(\'#dashboard\',"slide",false,true);
				
					// refresh the list to make sure the theme applies properly
					$(\'#wikiList\').listview(\'refresh\');
				});
			};

			// Success function for Geolocation call
			function onSuccess(position)
			{
				geonames.search(position.coords.latitude,position.coords.longitude);
			}

			// Error function for Geolocation call
			function onError(msg)
			{
				alert(msg);
			}
			
			// dialog appearance
			$(function() {
				$( "#dialog" ).dialog();
				
			// hides the x button from the dialog
			$(\'a[data-icon=delete]\').hide();
			});
	</script>
    </head>
	';
	echo "
    <body>

	<!-- HEADER -->
		<div data-role=\"dialog\" id=\"$pageId\" data-overlay-theme=\"b\">
          <div data-theme=\"$theme\" data-role=\"header\">
		  
				<h3>
				</br>
				<!-- <h2>Respond with Love</h2> -->
				<div style=\" text-align:center;\">
					<img src=\"logo.gif\" width=\"50%\">
				</div>
				</h3>
				<a href=\"logout.php\" rel=\"external\" data-theme=\"b\" class=\"ui-btn-right\">Logout</a>
				<a href=\"menu.php\" rel=\"external\" data-theme=\"b\" class=\"ui-btn-left\">Home</a>
                
		  </div>
		  <!--/HEADER -->";

		  
?>
