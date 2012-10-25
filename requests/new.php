<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>
		Request Menu
        </title>
        <!-- link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.css" / -->
        <link rel="stylesheet" href="my.css" />
	<link rel="stylesheet" href="http://jquerymobile.com/demos/1.2.0-alpha.1/css/themes/default/jquery.mobile-1.2.0-alpha.1.css" />
        <style>
            /* App custom styles */
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">
        </script>
        <!-- script src="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.js"></script -->
	<script src="http://jquerymobile.com/demos/1.2.0-alpha.1/js/jquery.mobile-1.2.0-alpha.1.js"></script>
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
                <div data-role="navbar">
                    <ul>
                        <li>
                            <a href="" data-theme="" class="ui-btn-active ui-state-persist">
                                New
                            </a>
                        </li>
                        <li>
                            <a href="pending.php" data-theme="">
                                Pending
                            </a>
                        </li>
                        <li>
                            <a href="confirmed.php" data-theme="">
                                Confirmed
                            </a>
                        </li>
                    </ul>
                </div>
            
		<a href="#popuptest2" data-role="button" data-theme="e" data-icon="star" data-iconpos="right" class="ui-content" data-rel="popup" data-position-to="window">
			[Name] wants a ride! (new request, theme e)
		</a>
		<a href="#popuptest" class="ui-content"  data-role="button" data-theme="b" data-rel="popup" data-position-to="window">
			[Name] wants to share! (one that's been looked at)
		</a>
		<div data-role="popup" id="popuptest" href="" data-overlay-theme="a">
    			<div data-theme="d">
       			 <h2>
       			     [Name] [Last name]
       			 </h2>
				<h4> Time: From [Start] to [End] </h4>
				<h4> Cost: $[Cost] </h4>
				<h4> Rating: [Rating] </h4>
				<a href="#../confirm/passengerconfirm.php" data-role="button" data-inline="true" data-theme="b">Accept and Pay</a>
				<a href="" data-role="button" data-inline="true">Cancel</a>
    			</div>
		</div>
		<div data-role="popup" id="popuptest2" href="#../popup/moreinforequest.php" data-overlay-theme="a">
    			<div data-theme="d">
       			 <h2>
       			     [Name] [Last name]
       			 </h2>
				<h4> Time: From [Start] to [End] </h4>
				<h4> Willing to pay: $[Price] </h4>
				<h4> Rating: [Rating] </h4>
				<a href="#../confirm/driverconfirm.php" data-role="button" data-inline="true" data-theme="b">Accept and Share</a>
				<a href="" data-role="button" data-inline="true">Cancel</a>
    			</div>
		</div>	
	
	   </div>

        </div>

	

        <script>
            //App custom javascript
        </script>
    </body>
</html>