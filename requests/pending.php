 <!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>
        </title>
        <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
        <link rel="stylesheet" href="my.css" />
        <style>
            /* App custom styles */
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">
        </script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.js">
        </script>
        <script src="my.js">
        </script>
    </head>
    <body>
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
            <div data-role="content">
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
				<h4> Cost: $<span id="popup_pay"></span> </h4>
				<h4> Rating: [Rating] </h4>
				<a href="#../confirm/passengerconfirm.php" data-role="button" data-inline="true" data-theme="b">Accept and Pay</a>
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
				<a href="#../confirm/driverconfirm.php" data-role="button" data-inline="true" data-theme="b">Accept</a>
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
					new Request(request[0], request['is_new'], request['type'], request['leave_time'], request['return_time'], request['pay'], request['first_name'], request['last_name']);
				}
				
				$.mobile.loading('hide');
			});
		}

		function Request(id, is_new, type, leave_time, return_time, pay, first_name, last_name) {
			this.id = id;
			this.is_new = is_new;
			this.type = type;
			this.leave_time = leave_time;
			this.return_time = return_time;
			this.pay = pay;
			this.first_name = first_name;
			this.last_name = last_name;

			var caption = first_name + " wants ";
			if(type == "driver") {
				caption += "to share your ride";
			} else {
				caption += "wants a ride";
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