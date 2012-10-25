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
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtYm5TmCLumSzzGZjqw_ArsHWcBVEm6b0&sensor=true">
		</script>
        <script src="http://jquerymobile.com/demos/1.2.0-alpha.1/js/jquery.mobile-1.2.0-alpha.1.js">
        </script>
    </head>
    <body>
        <!-- Home -->
        <div data-role="page" id="page1">
            <div data-theme="a" data-role="header" style="z-index:2;">
                <h3 style="margin-left: 0px; margin-right: 0px">
                    Click Your Destination
                </h3>
            </div>
			
			<div id="test">
				<table style="background-color:rgba(100,100,100,0.5); padding: 4x; width: 100%">
				<tr>
				<td>
				<span style="padding-right: 5px; color: white; text-shadow: 0 0 0 white;">Leave</span>
				</td>
				<td><select id="start_hour" name="start_hour" data-mini="true">
					<option>7</option>
				</select></td>
				<td>
				<select id="start_min" name="start_min" data-mini="true">
					<option>7</option>
				</select>
				</td>
				<td>
				<select id="start_ampm" name="start_ampm" data-mini="true">
					<option>am</option>
					<option>pm</option>
				</select>
				</td>
				</tr><tr>
				<td>
				<span style="padding-right: 5px; color: white; text-shadow: 0 0 0 white;">Return</span>
				</td>
				<td>
				<select id="end_hour" name="end_hour" data-mini="true">
					<option>7</option>
				</select></td>
				<td><select id="end_min" name="end_min" data-mini="true">
					<option>7</option>
				</select></td>
				<td><select id="end_ampm" name="end_ampm" data-mini="true">
					<option>am</option>
					<option>pm</option>
				</select></td></tr></table>
			</div>
			<div id="map_canvas" style="width:100%; height: 100%"></div>
			
		<div data-role="popup" id="trip_popup" href="#../popup/app.php" data-overlay-theme="a">
            		<div data-theme="d" data-role="header">
                		<h3>
                    			Go Here?
                		</h3>
            		</div>
            		<div data-role="content">
                		<h2>
							Price: <!-- PHP --> $<span id="trip_price">5</span><br/>
							Rating: <span id="trip_rating">4.8/5</span><br/>
							Leave: <span id="trip_leave_time"></span><br/>
							Return: <span id="trip_return_time"></span>
                		</h2>
                		<a data-role="button" data-theme="b" href="../main/app.php">
                    			Request to <!-- PHP --> ... a ride!
                		</a>
						<input onclick="$('#trip_popup').popup('close')" type="submit" value="Cancel" />
            		</div>
		</div>	
		
		<div data-role="popup" id="new_trip_popup" data-overlay-theme="a">
            		<div data-theme="a" data-role="header">
                <h3 style="margin-left: 0px; margin-right: 0px">
                    <!-- Vary message based on PHP -->
					New Ride
                </h3>
            </div>
            <div data-role="content">
                <h2>
					<!-- PHP -->
                    Varied
                </h2>
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup">
                            <label for="slider3">
                                Rate:
                            </label>
                            <input id="new_trip_rate" type="range" name="slider" value="15" min="0" max="50" data-highlight="false" />
                        </fieldset>
                    </div>
                <a onclick="finalizeNewTrip()" data-role="button" data-theme="b" href="#page1">
                    Confirm
                </a>
				<input onclick="$('#new_trip_popup').popup('close')" type="submit" value="Cancel" />
            </div>
		</div>

        </div>
        <script>
          var map;
		
		function initialize() {
		  
		  var mapOptions = {
			zoom: 20,
			center: new google.maps.LatLng(37.394137078995094, -122.07964084788512),
			zoomControl: true,
			panControl: false,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		  };

		  document.getElementById('map_canvas').style.height = $(document).height() - $('#test').height() - 44 + "px"
		  map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);

		  new Trip('15', true, map.getCenter(), "11:00pm", "11:30pm");	

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
		}
		
		google.maps.event.addDomListener(window, 'load', initialize);
		
	var new_trip_location;
	function createTrip(location) {
		alert(location)
		/*var marker = new google.maps.Marker({
		position: location,
		map: map
			});*/
		map.setCenter(location);
		new_trip_location = location;
		
		$('#new_trip_popup').popup("open", { overlayTheme: "a" });
		
		//ui-btn-active
		
		//google.maps.event.addListener(marker, 'click', function() {
			//$('#trip_popup').popup("open", { overlayTheme: "a" });
			//map.setZoom(8);
			//map.setCenter(marker.getPosition());
		  //});
	}
	
	function finalizeNewTrip() {
		//php for is_rider
		var leave_time = $("#start_hour").val() + $("#start_min").val() + $("start_ampmp").val();
		var return_time = $("#end_hour").val() + $("#end_min").val() + $("end_ampmp").val();
		new Trip($("#new_trip_rate").val(), true, new_trip_location, leave_time, return_time);
	}
	
	function Trip(rate, is_rider, location, leave_time, return_time) {
		this.rate = rate;
		this.is_rider = is_rider;
		this.location = location;
		this.leave_time = leave_time;
		this.return_time = return_time;
		
		var marker = new google.maps.Marker({
			position: location,
			map: map
		});
		
		google.maps.event.addListener(marker, 'click', function() {
			$("#trip_price").html(rate);
			$('#trip_popup').popup("open", { overlayTheme: "a" });
			$('#trip_leave_time').html(leave_time);
			$('#trip_return_time').html(return_time);
			map.setCenter(marker.getPosition());
		});
	}
	
        </script>
    </body>
</html>