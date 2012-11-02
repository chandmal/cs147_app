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
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>
        </title>
        <link rel="stylesheet" href="http://jquerymobile.com/demos/1.2.0-alpha.1/css/themes/default/jquery.mobile-1.2.0-alpha.1.css" />
        <link rel="stylesheet" href="my.css" />
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
    <body onload="getRequests()">
        <!-- Home -->
        <div data-role="page" id="page1">
            <div data-theme="a" data-role="header">
                <h3>
                    Requests
                </h3>
                <a data-role="button" href="../main/app.php" class="ui-btn-right" rel="external">
                    Menu
                </a>
            </div>
           <div data-role="content" id="content">
                <div data-role="navbar">
                    <ul>
                        <li>
                            <a href="new.php" data-theme="" rel="external">
                                To you
                            </a>
                        </li>
                        <li>
                            <a href="pending.php" data-theme="" rel="external" class="ui-btn-active ui-state-persist">
                                From you
                            </a>
                        </li>
                        <li>
                            <a href="confirmed.php" data-theme="" rel="external">
                                Confirmed
                            </a>
                        </li>
                    </ul>
                </div>
            
		<div data-role="popup" id="popup" href="" data-overlay-theme="a" data-dismissable="false">
			<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    			<div data-theme="d" data-dismissable="false">
       			 <h2>
       			     <span id="popup_name"></span>
       			 </h2>
				<h4> Time: From <span id="popup_leave_time"></span> to <span id="popup_return_time"></span></h4>
				<h4> Pay: $<span id="popup_pay"></span> </h4>
				<a href="#" onclick="$('#popup').popup('close')" id="popup_accept" data-role="button" data-inline="true" data-theme="b">Close</a>
    			</div>
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

			$.get('get_from_you_requests.php', function(requests) {
				requests = eval(requests);
				if(requests.length == 0) {
					var caption = "No requests here. Click here to the home screen.";
					var initial_theme = "a";
					var button = $('<a href="../main/app.php" data-role="button" class="ui-content" data-position-to="window" rel="external" data-theme="' + initial_theme + '">' + caption + '</a>');
					$("#content").append(button).trigger('create');
				}
				for(var i = 0; i < requests.length; i++) {
					var request = requests[i];
					new Request(request[0], request['is_new'], request['request_type'], request['leave_time'], request['return_time'], request['pay'], request['paid'], request['first_name'], request['last_name']);
				}
				
				$.mobile.loading('hide');
			});
		}

		function Request(id, is_new, request_type, leave_time, return_time, pay, paid, first_name, last_name) {
			this.id = id;
			this.is_new = is_new;
			this.request_type = request_type;
			this.leave_time = leave_time;
			this.return_time = return_time;
			this.pay = pay;
			this.first_name = first_name;
			this.last_name = last_name;

			var caption = "You ";
			if(request_type == "rider_to_driver") {
				caption += "want a ride from " + first_name;
			}
			if(request_type == "driver_to_rider") {
				caption += "want to share your ride with " + first_name;
			}
			if(request_type == "payment_driver_to_rider") {
				caption += "are waiting for payment from " + first_name;
			}

			var obj = this;		

			var initial_theme = "b";
			var button = $('<a href="#" data-role="button" class="ui-content" data-position-to="window" data-theme="' + initial_theme + '">' + caption + '</a>');
			$("#content").append(button).trigger('create');
			button.click(function() {
				$("#popup_name").html(obj.first_name + " " + obj.last_name);
				$("#popup_pay").html(obj.pay);
				$("#popup_leave_time").html(obj.leave_time);
				$("#popup_return_time").html(obj.return_time);

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