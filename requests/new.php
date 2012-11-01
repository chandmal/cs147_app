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
		Request Menu
        </title>
        <link rel="stylesheet" href="my.css" />
	 <link rel="stylesheet" href="http://jquerymobile.com/demos/1.2.0-alpha.1/css/themes/default/jquery.mobile-1.2.0-alpha.1.css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">
        </script>
        <script src="http://jquerymobile.com/demos/1.2.0-alpha.1/js/jquery.mobile-1.2.0-alpha.1.js"></script>
        <script src="my.js">
        </script>
    </head>
    <body onload="getRequests()">
        <!-- Home -->
        <div data-role="page" id="page1">
            <div data-theme="a" data-role="header">
                <a data-role="button" data-rel="back" href="#page1" class="ui-btn-left">
                    Back
                </a>
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
                            <a href="" data-theme="" class="ui-btn-active ui-state-persist">
                                To you
                            </a>
                        </li>
                        <li>
                            <a href="pending.php" data-theme="" rel="external">
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
				<h4> Rating: [Rating] </h4>
				<a href="#" id="popup_accept" data-role="button" data-inline="true" data-theme="b">Accept and Pay</a>
				<a href="" data-rel="back" data-role="button" data-inline="true">Cancel</a>
    			</div>
		</div>
		<div data-role="popup" id="popuptest2" href="#../popup/moreinforequest.php" style="max-width: 610px;" data-overlay-theme="a" data-dismissable="false" data-disabled="false" aria-disabled="false">
			<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    			<div data-theme="d" data-dismissable="false">
       			 <h2>
       			     [Name] [Last name]
       			 </h2>
				<h4> Time: From [Start] to [End] </h4>
				<h4> Willing to pay: $[Price] </h4>
				<h4> Rating: [Rating] </h4>
				<a rel="external" href="#" data-role="button" data-inline="true" data-theme="b">Accept</a>
				<a href="" data-rel="back" data-role="button" data-inline="true">Cancel</a>
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

			$.get('get_to_you_requests.php', function(requests) {
				requests = eval(requests);
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
			this.paid = paid;
			this.first_name = first_name;
			this.last_name = last_name;

			var caption = first_name + " ";
			if(request_type == "rider_to_driver") {
				caption += "wants a ride";
			}
			if(request_type == "driver_to_rider") {
				caption += "wants to share their ride";
			}
			if(request_type == "payment_driver_to_rider") {
				caption += "has agreed to share their ride.  Pay now!";
			}

			var obj = this;		

			var initial_theme = is_new == 1 ? "e" : "b";
			var button = $('<a href="#" data-role="button" class="ui-content" data-position-to="window" data-theme="' + initial_theme + '">' + caption + '</a>');
			$("#content").append(button).trigger('create');
			button.click(function() {
				$("#popup_name").html(obj.first_name + " " + obj.last_name);
				$("#popup_pay").html(obj.pay);
				$("#popup_leave_time").html(obj.leave_time);
				$("#popup_return_time").html(obj.return_time);
		
				if(obj.request_type == "rider_to_driver") {
					//$("#popup_accept .ui-btn-text").text("");
					$("#popup_accept .ui-btn-inner").text("Accept");
					$("#popup_accept").unbind('click');
					$("#popup_accept").click(function() {
						$.get("accept_request.php", { id : obj.id }, function() {
						});
						button.css('display', 'none');
						$("#popup").popup('close');
					});
				} 

				if(obj.request_type == "driver_to_rider" || "payment_driver_to_rider")  {
					$("#popup_accept .ui-btn-text").text("Accept and Pay");
					$("#popup_accept").unbind('click');
					$("#popup_accept").click(function() {
						$.get("accept_request.php", { id : obj.id }, function() {
						});
						button.css('display', 'none');
						$("#popup").popup('close');
					});					
				}

				//$("#popup_button").html();
				if(obj.is_new == 1) {
					//reset all the buttons widgets
    				button
                       	.removeClass('ui-btn-up-a ui-btn-up-b ui-btn-up-c ui-btn-up-d ui-btn-up-e ui-btn-hover-a ui-btn-hover-b ui-btn-hover-c ui-btn-hover-d ui-btn-hover-e')
                       	.addClass('ui-btn-up-' + 'b')
                      	 .attr('data-theme', 'b');
					var data = {};
					data['id'] = obj.id;
					$.post('mark_as_read.php', data, function(response) {
					});
				}
				$("#popup").popup('open', { overlayTheme: "a" });
			});

			
		}
        </script>
    </body>
</html>