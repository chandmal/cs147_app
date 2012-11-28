<?php

$path = '/afs/ir.stanford.edu/users/h/o/holstein/cgi-bin/dev/cs147_app/lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('db.php');
require_once('user.php');
require_once('request_counting.php');

?>

 <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>
        </title>
        <link rel="stylesheet" href="http://jquerymobile.com/demos/1.2.0-alpha.1/css/themes/default/jquery.mobile-1.2.0-alpha.1.css" />
        <link rel="stylesheet" href="my.css" />
	 <link rel="stylesheet" href="../new_icons/new_icons.css" />
        <style>
            /* App custom styles */
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">
        </script>
        <script src="http://jquerymobile.com/demos/1.2.0-alpha.1/js/jquery.mobile-1.2.0-alpha.1.js"></script>
        </script>
        <script src="my.js">
        </script>
    </head>
    <body onload="getRequests();">
        <!-- Home -->
        <div data-role="page" id="page1">
            <div data-theme="a" data-role="header">
                <h3>
                    My Rides
                </h3>
                <a data-role="button" href="../map/app2.php?" class="ui-btn-right" data-ajax="false">
                    Home
                </a>
            </div>
           <div data-role="content" id="content">
                <div data-role="navbar">
                    <ul>
			<?

			$num_new_requests = num_new_to_you_requests();

			$data_icon = "";
			if($num_new_requests > 0) {
				$data_icon = ' data-icon="new-';
				$data_icon .= $num_new_requests <= 9 ? $num_new_requests : "more";
				$data_icon .= '" data-iconpos="right" ';
			}

			?>

                        <li>
                            <a href="new2.php" data-inline="false" data-theme="" data-ajax="false" <?= $data_icon ?>>
                                Requests
                            </a>
                        </li>
                        <li>
                            <a class="ui-btn-active ui-state-persist" href="pending2.php" data-theme="" data-ajax="false">
                                Pending
                            </a>
                        </li>
<?
			$num_new_requests = num_new_confirm_requests();

			$data_icon = "";
			if($num_new_requests > 0) {
				$data_icon = ' data-icon="new-';
				$data_icon .= $num_new_requests <= 9 ? $num_new_requests : "more";
				$data_icon .= '" data-iconpos="right" ';
			}
?>
                        <li>
                            <a href="confirmed2.php" data-theme="" data-ajax="false" <?= $data_icon ?>>
                                Confirmed
                            </a>
                        </li>
                    </ul>
                </div>
            
		<div data-role="popup" id="popup" href="" data-overlay-theme="a">
    			<div data-theme="d" data-role="header">
       			 <h2 style="margin-right:0px; margin-left:0px;">
       			     <span id="popup_name"></span>
       			 </h2>
			</div><h3>
				<table cellspacing="15">
				<tr><td>Leave:</td><td><span id="popup_leave_time"></span></td>
				<tr><td>Return:</td><td><span id="popup_return_time"></span></td></tr>
				<tr><td>Rate:</td><td>$<span id="popup_pay"></span></td></tr>
				<tr><td>Ratings:</td>
				<td>
							<table>
							<td><span id="trip_thumbs_up"></span></td>
							<td><img style="width:40px" src="../icons/thumbup.png" /></td>
							<td>&nbsp;&nbsp;</td>
							<td><span id="trip_thumbs_down"></span></td>
							<td><img style="width:40px" src="../icons/thumbdown.png" /></td>
							</tr>
							</table>

				</td>
				</tr>
				</table>
				<a href="#" onclick="$('#popup').popup('close')" id="popup_accept" data-role="button" data-theme="b">Close</a>
			</h3>
		</div>	
	
	   </div>

        </div>
      <script>

		function getRequests() {
			$.mobile.loading( 'show', {
				text: 'Getting requests...',
				textVisible: true,
				theme: 'a'
			});

			$('.ui-btn-inner').not(':contains("Home")').css('padding-left', '0');
			$('.ui-btn-inner').not(':contains("Home")').css('padding-right', '0');


			$.get('get_from_you_requests.php', function(requests) {
				requests = eval(requests);
				if(requests.length == 0) {
					var caption = "No activity here. Click to go home.";
					var initial_theme = "a";
					var button = $('<a href="../map/app2.php" data-role="button" class="ui-content" data-position-to="window" data-ajax="false" data-theme="' + initial_theme + '" data-mini="true">' + caption + '</a>');
					$("#content").append(button).trigger('create');
				}
				for(var i = 0; i < requests.length; i++) {
					var request = requests[i];
					new Request(request[0], request['is_new'], request['request_type'], request['leave_time'], request['return_time'], request['pay'], request['paid'], request['first_name'], request['last_name'], request['thumbs_up'], request['thumbs_down']);
				}
				
				$.mobile.loading('hide');
			});
		}

		function Request(id, is_new, request_type, leave_time, return_time, pay, paid, first_name, last_name, thumbs_up, thumbs_down) {
			this.id = id;
			this.is_new = is_new;
			this.request_type = request_type;
			this.leave_time = leave_time;
			this.return_time = return_time;
			this.pay = pay;
			this.first_name = first_name;
			this.last_name = last_name;
			this.thumbs_up = thumbs_up;
			this.thumbs_down = thumbs_down;

			var caption = "You ";
			if(request_type == "rider_to_driver") {
				caption += "want a ride from " + first_name;
			}
			if(request_type == "driver_to_rider") {
				caption += "want to share your ride with " + first_name;
			}
			if(request_type == "payment_driver_to_rider") {
				caption += "are waiting for " + first_name + " to pay";
			}

			var obj = this;		

			var initial_theme = "b";
			var button = $('<a href="#" data-role="button" class="ui-content" data-position-to="window" data-theme="' + initial_theme + '" data-mini="true">' + caption + '</a>');
			$("#content").append(button).trigger('create');
			button.click(function() {
				$("#popup_name").html(obj.first_name + " " + obj.last_name);
				$("#popup_pay").html(obj.pay);
				$("#popup_leave_time").html(obj.leave_time);
				$("#popup_return_time").html(obj.return_time);
				$("#trip_thumbs_up").html(obj.thumbs_up);
				$("#trip_thumbs_down").html(obj.thumbs_down);

				//$("#popup_button").html();
				if(obj.is_new == 1) {
					//reset all the buttons widgets
    				button
                       	.removeClass('ui-btn-up-a ui-btn-up-b ui-btn-up-c ui-btn-up-d ui-btn-up-e ui-btn-hover-a ui-btn-hover-b ui-btn-hover-c ui-btn-hover-d ui-btn-hover-e')
                       	.addClass('ui-btn-up-' + 'b')
                      	 .attr('data-theme', 'b');
					var data = {};
					data['id'] = obj.id;
				}
				$("#popup").popup('open', { overlayTheme: "a" });
			});
		}
        </script>
    </body>
</html>