<?php

$path = '/afs/ir.stanford.edu/users/h/o/holstein/cgi-bin/dev/cs147_app/lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('db.php');

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>
		Sign Up
        </title>
        <!--<link rel="stylesheet" href="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.css" />-->
        <link rel="stylesheet" href="my.css" />
	 <link rel="stylesheet" href="http://jquerymobile.com/demos/1.2.0-alpha.1/css/themes/default/jquery.mobile-1.2.0-alpha.1.css" />
        <style>
            /* App custom styles */
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js">
        </script>
        <!--<script src="https://ajax.aspnetcdn.com/ajax/jquery.mobile/1.1.1/jquery.mobile-1.1.1.min.js">
        </script>-->

        <script src="http://jquerymobile.com/demos/1.2.0-alpha.1/js/jquery.mobile-1.2.0-alpha.1.js"></script>
        <script src="my.js">
        </script>
    </head>
    <body>
        <!-- Home -->
        <div data-role="page" id="page1">
            <div data-theme="a" data-role="header">
                <h3>
                    Sign Up
                </h3>
		  <a data-role="button" data-rel="" data-ajax="false" href="../login/app.php" class="ui-btn-right">
                    Or log in!
                </a>
            </div>
            <div data-role="content">
                <h2>
                    So you're new, eh?
                </h2>
                <h4 style="margin-bottom: 0px">
                    Fill out the information so you can start sharing rides today.
                </h4>
		  <span style="font-size:12px; color: red">*All fields are required.</span>
                <form action="" id="signup_form" method="post" data-ajax="false">
                    <div class="ui-grid-a">
                        <div class="ui-block-a">
                            <div data-role="fieldcontain">
                                <fieldset data-role="controlgroup" data-mini="true">
                                    <label for="textinput7">
                                    </label>
                                    <input name="first_name" id="first_name" placeholder="First name" value="" type="text" />
                                </fieldset>
                            </div>
                        </div>
                        <div class="ui-block-b">
                            <div data-role="fieldcontain">
                                <fieldset data-role="controlgroup" data-mini="true">
                                    <label for="textinput8">
                                    </label>
                                    <input name="last_name" id="last_name" placeholder="Last name" value="" type="text" />
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup" data-mini="true">
                            <label for="textinput1">
                            </label>
                            <input name="username" id="username" placeholder="Username" value="" type="text" />
                        </fieldset>
                    </div>
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup" data-mini="true">
                            <label for="textinput4">
                            </label>
                            <input name="password" id="password" placeholder="Password" value="" type="password" />
                        </fieldset>
                    </div>
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup" data-mini="true">
                            <label for="textinput6">
                            </label>
                            <input name="confirm_password" id="confirm_password" placeholder="Confirm password" value="" type="password" />
                        </fieldset>
                    </div>
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup" data-mini="true">
                            <label for="textinput5">
                            </label>
                            <input name="school_email" id="school_email" placeholder="School email" value="" type="email" />
                        </fieldset>
                    </div>
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup" data-mini="true">
                            <label for="textinput5">
                            </label>
                            <input name="phone" id="phone" placeholder="Phone" value="" />
                        </fieldset>
                    </div>
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup" data-mini="true">
                            <label for="textinput2">
                            </label>
                            <input name="paypal_email" id="paypal_email" placeholder="Paypal email" value="" type="email" />
                        </fieldset>
                    </div>
                    <div>
                        <a href="https://www.paypal.com" target="_blank" data-transition="fade">
                            Don't have PayPal? Click here!
                        </a>
                    </div>
		      <input type="button" data-theme="" onclick="submitForm()" value="Submit" />
            		
		</form>
			
		<div data-role="popup" id="popuptest" href="#../popup/signupconf.php" data-overlay-theme="a">
            		<div data-theme="d" data-role="header">
				<h3>Success</h3>
            		</div>
            		<div data-role="content">
                		<h2>
                    			Great! You're in!
                		</h2>
                		<a data-role="button" data-ajax="false" data-theme="b" href="../main/app.php">
                    			Check it out!
                		</a>
            		</div>
		</div>	
            </div>
        </div>
        <script>
		function submitForm() {
			if($("#first_name").val().length == 0) {
				alert('Enter your first name.');
				return false;
			}

			if($("#last_name").val().length == 0) {
				alert('Enter your last name.');
				return false;
			}

			if($("#username").val().length == 0) {
				alert('Enter your username.');
				return false;
			}

			if($("#password").val().length < 5) {
				alert('For your security, enter a password at least 5 characters long.');
				return false;
			}

			if($("#password").val() != $("#confirm_password").val()) {
				alert('Password and confirmation password do not match.');
				return false;
			}

			if($("#school_email").val().length == 0) {
				alert('Enter your school email.');
				return false;
			}

			if($("#phone").val().length == 0) {
				alert('Enter your phone number.');
				return false;
			}

			if($("#phone").val().length >= 20) {
				alert('Your phone number must be less 20 digits.');
				return false;
			}

			if($("#paypal_email").val().length == 0) {
				alert('Enter your paypal email.');
				return false;
			}

			$.mobile.loading( 'show', {
				text: 'Creating your account...',
				textVisible: true,
				theme: 'a'
			});

			$.ajax({
  				type: 'POST',
				url: 'create_account.php',
				data: $("#signup_form").serialize(),
				async: false
			}).done(function(data) {
				data = eval(data);
				$.mobile.loading('hide');
				if(data[0] == 1) {
					$('#popuptest').popup("open", { overlayTheme: "a" });
				} else {
					alert(data[1]);
				}
			});
		}
        </script>
    </body>
</html>