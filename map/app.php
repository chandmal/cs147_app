<?php

$path = '/afs/ir.stanford.edu/users/h/o/holstein/cgi-bin/dev/cs147_app/lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('db.php');
require_once('user.php');

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <!-- <meta name="viewport" content="width=device-width, initial-scale=1" /> -->
		<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
        <title>
        </title>
        <link rel="stylesheet" href="http://jquerymobile.com/demos/1.2.0-alpha.1/css/themes/default/jquery.mobile-1.2.0-alpha.1.css" />
        <link rel="stylesheet" href="my.css" />
        <style>
            /*html { height: 100% }
			body { height: 100%; margin: 0; padding: 0 }*/
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">
        </script>
		<script type="text/javascript"
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtYm5TmCLumSzzGZjqw_ArsHWcBVEm6b0&sensor=true&libraries=places">
		</script>
        <script src="jquery.mobile-1.2.0-alpha.1.js">
        </script>
    </head>
    <body>
        <!-- Home -->
        <div data-role="page" id="page1">
            <div data-theme="a" data-role="header" style="z-index:2;">
                <h3 style="margin-left: 0px; margin-right: 0px">
                    Interact
                </h3>
		  <a data-role="button" href="#" class="ui-btn-left" onclick="$('#help_popup').popup('open', { overlayTheme: 'a' });">
                    Help
                </a>
		  <a data-role="button" href="../main/app.php" class="ui-btn-right" rel="external">
                    Home
                </a>
            </div>
			
			<div id="test">
				<table style="background-color:rgba(100,100,100,0.5); padding: 4x; width: 100%">
				<tr>
				<td style="text-shadow: none; color: white; font-weight:bold">Search</td>
				<td><input type="search" id="places_autocomplete"/></td>
				</tr>
				</table>
			</div>
			<div id="map_canvas" style="width:100%; height: 100%"></div>
		
		<div data-role="popup" id="help_popup" data-overlay-theme="a">
			<div data-theme="a" data-role="header">
	                	<h3>
       	       	     	Map Help
              	  	</h3>
			</div>
	            <div data-role="content">
                <h2>
                    How To Use This Map:
                </h2>
                <h4>
			<ul>
				<li>To view an existing destination, tap on an existing marker on the map.</li><br/>
				<li>To create a new destination, tap where you want to go.</li><br/>
				<li>To view your own destinations, tap on your green destination markers.</li><br/>
				<li>All rides leave within the next 24 hours only.</li>
			</ul>
                </h4>	
			  <a href="#" data-role="button" data-theme="b" onclick="$('#help_popup').popup('close');"> Back to Map </a>
	            </div>

		</div>

		<div data-role="popup" id="trip_popup" data-overlay-theme="a">
            		<div data-theme="d" data-role="header">
                		<h3 style="margin-left: 0; margin-right: 0">
					Check Out This <?= $_SESSION['user_type'] == "driver" ? "Passenger" : "Ride" ?>
                		</h3>
            		</div>
            		<div data-role="content">
                		<h3>
					<table cellspacing="15">
						<tr><td>
							Rate:</td><td><!-- PHP -->$<span id="trip_price">5</span>
						</td></tr>
							<tr><td>Leave:</td><td><span id="trip_leave_time"></span></td></tr>
							<tr><td>Return:</td><td><span id="trip_return_time"></span></td></tr>
							
							<tr><td>
							Ratings:</td>
							<td>
							<table>
							<td><span id="trip_thumbs_up"></span></td>
							<td><img style="width:40px" src="../icons/thumbup.png" /></td>
							<td>&nbsp;&nbsp;</td>
							<td><span id="trip_thumbs_down"></span></td>
							<td><img style="width:40px" src="../icons/thumbdown.png" /></td>
							</tr>
							</table>
					</table>
                		</h3>
                		<a id="request_button" data-role="button" data-theme="b">
                    			Request this <?= $_SESSION['user_type'] == "driver" ? "Passenger" : "Ride" ?>
                		</a>
						<input onclick="$('#trip_popup').popup('close')" type="submit" value="Back To Map" />
            		</div>
		</div>	

		<div data-role="popup" id="my_trip_popup" data-overlay-theme="a">
            		<div data-theme="d" data-role="header">
                		<h3 style="margin-left: 0; margin-right: 0">
					My <?= $_SESSION['user_type'] == "driver" ? "Trip" : "Ride" ?>
                		</h3>
            		</div>
            		<div data-role="content">
                		<h3>
					<table cellspacing="15">
						<tr><td>
							Rate:</td><td><!-- PHP -->$<span id="my_trip_price">5</span>
						</td></tr>
							<tr><td>Leave:</td><td><span id="my_trip_leave_time"></span></td></tr>
							<tr><td>Return:</td><td><span id="my_trip_return_time"></span></td></tr>
					</table>
                		</h3>
                		<a data-role="button" data-theme="b" onclick="$('#my_trip_popup').popup('close')">
                    			Back To Map
                		</a>
					<input id="my_trip_cancel" type="submit" value="Cancel This <?= $_SESSION['user_type'] == "driver" ? "Trip" : "Ride" ?>"/>
            		</div>
		</div>	

		
		<div data-role="popup" id="new_trip_popup" data-overlay-theme="a">
            		<div data-theme="a" data-role="header">
                <h3 style="margin-left: 0px; margin-right: 0px">
                    <? if($_SESSION['user_type'] == "driver") { ?>
						Share Your Ride
					<? } else { ?>
						Request a Ride
					<? } ?>
                </h3>
            </div>
            <div data-role="content">
		  <table><tr><td colspan="4">
                <h4 style="padding: 1px; margin: 0px">
			<? if($_SESSION['user_type'] == "driver") { ?>
						This is my off-campus destination. I want to share my route, so passengers know.
					<? } else { ?>
						This is where I want to go.  I want to share this,
						so drivers know.
					<? } ?>
                </h4>
			</td></tr>
				<tr>
				<td>
				<h5>Leave</h5>
				</td>
				<td><select id="start_hour" name="start_hour" data-mini="true">
					<option name="12">12</option>
					<?php
						for($i = 1; $i <= 12; $i++) { 
							$selected = $i == (date('g') + 1) % 12 ? "selected" : "";
								?>
							<option name="<?php echo $i ?>" <?= $selected ?>><?php echo $i ?></option>
					<?php
						}
					?>
				</select></td>
				<td>
				<select id="start_min" name="start_min" data-mini="true">
					<option name=":00">:00</option>
					<option name=":15">:15</option>
					<option name=":30">:30</option>
					<option name=":45">:45</option>
				</select>
				</td>
				<td>
				<select id="start_ampm" name="start_ampm" data-mini="true">
					<? $newHour = (date('G') + 1) % 24;
						$selected = $newHour >= 12 ? "selected" : ""; ?>
					<option name="am">am</option>
					<option name="pm" <?= $selected ?>>pm</option>
				</select>
				</td>
				</tr><tr>
				<td>
				<h5>Return</h5>
				</td>
				<td>
				<select id="end_hour" name="end_hour" data-mini="true">
					<option name="12">12</option>
					<?php
						for($i = 1; $i <= 12; $i++) { 
							$selected = $i == (date('g') + 2) % 12 ? "selected" : "";
								?>
							<option name="<?php echo $i ?>" <?= $selected ?>><?php echo $i ?></option>
					<?php
						}
					?>
				</select></td>
				<td><select id="end_min" name="end_min" data-mini="true">
					<option name=":00">:00</option>
					<option name=":15">:15</option>
					<option name=":30">:30</option>
					<option name=":45">:45</option>
				</select></td>
				<td><select id="end_ampm" name="end_ampm" data-mini="true">
					<? 	$newHour = (date('G') + 2) % 24;
						$selected = $newHour >= 12 ? "selected" : ""; ?>
					<option name="am">am</option>
					<option name="pm" <?= $selected ?>>pm</option>
				</select></td></tr>
				<tr><td>
                            <h5>
                                Rate:
                            </h5></td><td colspan="3">
                            $<input id="new_trip_rate" type="range" name="slider" value="15" min="0" max="50" data-highlight="false" data-mini="true" /></td>
				</tr></table>
                        </fieldset>
                <a onclick="finalizeNewTrip()" data-role="button" data-theme="b" href="#page1" data-mini="true">
                    Confirm
                </a>
				<input onclick="$('#new_trip_popup').popup('close')" type="submit" value="Cancel" data-mini="true" />
            </div>
		</div>

        </div>
        <script>
          var map;
		
		function initialize() {
		  
		  var mapOptions = {
			zoom: 17,
			center: new google.maps.LatLng(37.42877627635624, -122.16983346549836),
			zoomControl: true,
			panControl: false,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		  };

		  document.getElementById('map_canvas').style.height = $(document).height() - $('#test').height() - 44 + "px"
		  map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

		  //new Trip('-1', '15', false, map.getCenter(), "11:00pm", "11:30pm");	

		  /*google.maps.event.addListener(marker, 'click', function() {
			$('#trip_popup').popup("open", { overlayTheme: "a" });
			map.setZoom(8);
			map.setCenter(marker.getPosition());
		  });*/
		  
		  google.maps.event.addListener(map, 'click', function(event) {
			createTrip(event.latLng);
		  });
		  
		  //var myControl = document.getElementById('test');
		  //myControl.index = 1;
		  //map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(myControl);

			var input = document.getElementById('places_autocomplete');
			autocomplete = new google.maps.places.Autocomplete(input);
			autocomplete.bindTo('bounds', map);

		   initializeRides();
		   
		    var infowindow = new google.maps.InfoWindow();
        var marker = new google.maps.Marker({
          map: map
        });

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();

          // If the place has a geometry, then present it on a map.
          //if (place.geometry.viewport) {
          //  map.fitBounds(place.geometry.viewport);
          //} else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);  // Why 17? Because it looks good.
          //}
          var image = new google.maps.MarkerImage(
              place.icon,
              new google.maps.Size(71, 71),
              new google.maps.Point(0, 0),
              new google.maps.Point(17, 34),
              new google.maps.Size(35, 35));
          marker.setIcon(image);
          marker.setPosition(place.geometry.location);

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindow.setContent('<div style=""><strong>' + place.name + '</strong><br>' + address);
          infowindow.open(map, marker);
        });

		}
		
		google.maps.event.addDomListener(window, 'load', initialize);
		
	var new_trip_location;
	function createTrip(location) {
		map.setCenter(location);
		new_trip_location = location;
		
		$('#new_trip_popup').popup("open", { overlayTheme: "a" });
	}


	function initializeRides() {
		var params = {};
		$.get('get_rides.php', params, function(response) {
			rides = eval(response);
			for(var i = 0; i < rides.length; i++) {
				var ride = rides[i];
				new Trip(ride['id'], ride['pay'], ride['user'], ride['user'] == <?= $_SESSION['user']?>, new google.maps.LatLng(ride['latitude'], ride['longitude']), ride['leave_time'], ride['return_time'], ride['user_info']['thumbs_up'], ride['user_info']['thumbs_down']);
			}
		});
		
	}
	
	function finalizeNewTrip() {
		//php for is_rider
		var leave_time = $("#start_hour").val() + $("#start_min").val() + $("#start_ampm").val();
		var return_time = $("#end_hour").val() + $("#end_min").val() + $("#end_ampm").val();
		var trip_id = createTripInDb($("#new_trip_rate").val(), new_trip_location, leave_time, return_time);
		var trip = new Trip(trip_id, $("#new_trip_rate").val(), <?= $_SESSION['user'] ?>, true, new_trip_location, leave_time, return_time, 0, 0);
		alert('Your trip was posted!  If someone wants to Share-A-Ride with you, you will receive a notification on your home page.  Click okay to continue browsing the map.');
	}
	
	function Trip(id, rate, post_user_id, is_yours, location, leave_time, return_time, thumbs_up, thumbs_down) {
		this.thumbs_up = thumbs_up;
		this.thumbs_down = thumbs_down;
		this.id = id;
		this.post_user_id = post_user_id;
		this.rate = rate;
		this.is_yours = is_yours;
		this.location = location;
		this.leave_time = leave_time;
		this.return_time = return_time;
		
		var obj = this;

		if(!is_yours) {
			var marker_image_path = "<?= $_SESSION['user_type'] == 'driver' ? "../icons/rider.png" : "../icons/driver.png" ?>";
			var marker = new google.maps.Marker({
				position: location,
				map: map,
				icon: marker_image_path
			});
			
			google.maps.event.addListener(marker, 'click', function() {
				map.setCenter(marker.getPosition());
				$("#trip_price").html(rate);
				$('#trip_leave_time').html(leave_time);
				$('#trip_return_time').html(return_time);
				$("#trip_thumbs_up").html(obj.thumbs_up);
				$("#trip_thumbs_down").html(obj.thumbs_down);
				$('#trip_popup').popup("open", { overlayTheme: "a" });

				request_ride_params = {};
				request_ride_params['to_user'] = obj.post_user_id;
				request_ride_params['ride_id'] = obj.id;

				$('#request_button').unbind('click');

				$('#request_button').click(function() {
					$.post('request_ride.php', request_ride_params, function(data) {
					});
					$('#trip_popup').popup('close');
					alert('Your request was sent!  When your request is approved, you will receive a notification on your home page.  Click okay to continue browsing the map.');
				});
			});

		} else {
			var marker = new google.maps.Marker({
				position: location,
				map: map,
				icon: '../icons/yours.png'
			});

			google.maps.event.addListener(marker, 'click', function() {
				map.setCenter(marker.getPosition());
				$("#my_trip_price").html(rate);
				$('#my_trip_leave_time').html(leave_time);
				$('#my_trip_return_time').html(return_time);
				$('#my_trip_popup').popup("open", { overlayTheme: "a" });
				$('#my_trip_cancel').click( function() {
					marker.setMap(null);
					$('#my_trip_popup').popup('close');
					obj.removeFromDb();
				});
			});
		}
	}

	Trip.prototype.removeFromDb = function() {
		var data = {};
		data['id'] = this.id;
		$.ajax({
 			type: "POST",
			url: "delete_ride.php",
			data: data
		});
	}

	function createTripInDb(rate, location, leave_time, return_time) {
		var data = {};
		data['lat'] = location['Ya'];
		data['long'] = location['Za'];
		console.log(data['lat'] + " " + data['long'])
		data['pay'] = rate;
		data['leave_time'] = leave_time;
		data['return_time'] = return_time;

		var trip_id = 0;
		$.ajax({
 			type: "POST",
			url: "create_ride.php",
			async: false,
			data: data
		}).done(function( response ) {
			trip_id = response;
		});

		return trip_id;
	}


	        </script>
    </body>
</html>