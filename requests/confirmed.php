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
                <a data-role="button" href="../main/app.php" class="ui-btn-right">
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
                            <a href="pending.php" data-theme="" rel="external">
                                From you
                            </a>
                        </li>
                        <li>
                            <a href="confirmed.php" data-theme="" rel="external" class="ui-btn-active ui-state-persist">
                                Confirmed
                            </a>
                        </li>
                    </ul>
                </div>
            
		<a href="#" data-role="button" data-theme="e" data-icon="star" data-iconpos="right" class="ui-content" data-rel="popup" data-position-to="window">
			[Name] wants a ride! (new request, theme e)
		</a>
		<a href="#popuptest" class="ui-content"  data-role="button" data-theme="b" data-rel="popup" data-position-to="window">
			[Name] wants to share! (one that's been looked at)
		</a>
		<div data-role="popup" id="popup" href="" data-overlay-theme="a" data-dismissable="false">
			<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    			<div data-theme="d" data-dismissable="false">
       			 <h2>
       			     <span id="popup_name"></span>
       			 </h2>
				<h4> Time: From <span id="popup_leave_time"></span> to <span id="popup_return_time"></span></h4>
				<h4> Pay: $<span id="popup_pay"></span> </h4>
				<h4> Give them a call: <span id="popup_phone"></span> </h4>
				<h4> Rating: [Rating] </h4>
				<a href="#" onclick="$('#popup').popup('close')" id="popup_accept" data-role="button" data-inline="true" data-theme="b">Close</a>
    			</div>
		</div>
	
	   </div>

        </div>
      <script>

		function getRequests() {
			$.mobile.loading( 'show', {
				text: 'Getting confirmed requests...',
				textVisible: true,
				theme: 'a'
			});

			$.get('get_confirmed_requests.php', function(requests) {
				requests = eval(requests);
				for(var i = 0; i < requests.length; i++) {
					var request = requests[i]['request'];
					var other_user = requests[i]['other_user'];
					var ride = requests[i]['ride'];
					new Request(request[0], request, request['request_type'], ride, other_user);
				}
				
				$.mobile.loading('hide');
			});
		}

		function Request(id, request, request_type, ride, other_user) {
			this.id = id;
			this.request = request;
			this.request_type = request_type;
			this.ride = ride;
			this.leave_time = ride['leave_time'];
			this.return_time = ride['return_time'];
			this.pay = ride['pay'];
			this.other_user = other_user;

			this.first_name = other_user['first_name'];
			this.phone = other_user['phone'];

			if(ride['type'] == "driver") {
				this.is_driver = <?= $_SESSION['user'] ?> == ride['user'];
			} else {
				this.is_driver = <?= $_SESSION['user'] ?> != ride['user'];
			}

			if(this.is_driver) this.is_new = this.request['is_new_for_driver'];
			if(!this.is_driver) this.is_new = this.request['is_new_for_rider'];

			var caption = "You ";
			if(this.is_driver) {
				caption += "are giving a ride to " + this.first_name;
			}
			else {
				caption += "are getting a ride from " + this.first_name;
			}

			caption += "<br/>" + other_user['phone'];

			var obj = this;

			var initial_theme = this.is_new == 1 ? "e" : "b";
			var button = $('<a href="#" data-role="button" class="ui-content" data-position-to="window" data-theme="' + initial_theme + '">' + caption + '</a>');
			$("#content").append(button).trigger('create');
			button.click(function() {
				$("#popup_name").html(obj.first_name + " " + obj.last_name);
				$("#popup_pay").html(obj.pay);
				$("#popup_leave_time").html(obj.leave_time);
				$("#popup_return_time").html(obj.return_time);
				$("#popup_phone").html(obj.phone);

				if(obj.is_new == 1) {
					$.post('mark_confirmed_as_read.php' ,{id: obj.id}, function(data) {
					});
					
					//reset all the buttons widgets
    				button
                       	.removeClass('ui-btn-up-a ui-btn-up-b ui-btn-up-c ui-btn-up-d ui-btn-up-e ui-btn-hover-a ui-btn-hover-b ui-btn-hover-c ui-btn-hover-d ui-btn-hover-e')
                       	.addClass('ui-btn-up-' + 'b')
                      	 .attr('data-theme', 'b');
				}
				$("#popup").popup('open', { overlayTheme: "a" });
			});
			
		}
        </script>
    </body>
</html>