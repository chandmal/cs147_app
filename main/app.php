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
		Main Menu
        </title>
        <link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.css" />
        <link rel="stylesheet" href="my.css" />
	 <link rel="stylesheet" href="../new_icons/new_icons.css" />
        <style>
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">
        </script>
        <script src="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.js">
        </script>
        <script src="my.js">
        </script>
    </head>
    <body onload="loader()">
        <!-- Home -->
        <div data-role="page" id="page1">
            <div data-theme="a" data-role="header">
                <a data-role="button" href="logout.php" rel="external" class="ui-btn-right">
                    Logout
                </a>
                <h3>
                    Main Menu
                </h3>
                <a data-role="button" data-rel="back" href="#page1" class="ui-btn-left">
                    Back
                </a>
            </div>
            <div data-role="content">
                <h2>
                    Hi, <?= $user['first_name'] ?>!
                </h2>
                <form action="../tadirections/app.php" method="POST">
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup" data-type="horizontal">
                            <legend>
                                I am a:
                            </legend>
                            <input id="radio3" onclick="driverClick()" name="user_type" value="driver" type="radio" />
                            <label id="driver_radio" for="radio3">
                                Driver
                            </label>
                            <input onclick="riderClick()" id="radio4" name="user_type" value="rider" type="radio" />
                            <label id="rider_radio" for="radio4">
                                Rider
                            </label>
                        </fieldset>
                    </div>
                </form>
		<a id="whereto_button" style="display:none" data-role="button" rel="external" data-theme="b" href="../tadirections/app.php">
			Where to?
		</a>
		
		<?
			$num_new_requests = num_new_to_you_requests();
			$num_new_requests += num_new_confirm_requests();

			$data_icon = "";
			if($num_new_requests > 0) {
				$data_icon = ' data-icon="new-';
				$data_icon .= $num_new_requests <= 9 ? $num_new_requests : "more";
				$data_icon .= '" data-iconpos="right" ';
			}
		?>
		<a id="requests_button" style="display:none" data-role="button" rel="external" data-theme="b" href="../requests/new.php" <?= $data_icon ?>>
			Check requests
		</a>
            </div>
        </div>
        <script>
		function loader() {
		     <? if($_SESSION['user_type'] == 'driver') { ?>
				driverClick();
		     <? } ?>
	
			<? if($_SESSION['user_type'] == 'rider') { ?>
				riderClick();
		     <? } ?>
		}
	
            function driverClick() {
			$.get('set_user_type.php', {user_type: 'driver'}, function() {
			});
			$("#whereto_button .ui-btn-text").text("Where to?");
			$("#whereto_button").fadeIn();
			$("#requests_button").fadeIn();
			$("#driver_radio").addClass('ui-btn-active');
	     }

            function riderClick() {
			$.get('set_user_type.php', {user_type: 'rider'}, function() {
			});
			$("#whereto_button .ui-btn-text").text("Where to?");
			$("#whereto_button").fadeIn();
			$("#requests_button").fadeIn();
			$("#rider_radio").addClass('ui-btn-active');
	     }

        </script>
    </body>
</html>