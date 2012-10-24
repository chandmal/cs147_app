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
		  <a data-role="button" data-rel="" href="../login/app.php" class="ui-btn-right">
                    Or log in!
                </a>
            </div>
            <div data-role="content">
                <h2>
                    So you're new, eh?
                </h2>
                <h4>
                    Fill out the information so you can start sharing rides today.
                </h4>
                <form action="" method="post" data-ajax="false">
                    <div class="ui-grid-a">
                        <div class="ui-block-a">
                            <div data-role="fieldcontain">
                                <fieldset data-role="controlgroup" data-mini="true">
                                    <label for="textinput7">
                                    </label>
                                    <input name="fname" id="textinput7" placeholder="First name" value="" type="text" />
                                </fieldset>
                            </div>
                        </div>
                        <div class="ui-block-b">
                            <div data-role="fieldcontain">
                                <fieldset data-role="controlgroup" data-mini="true">
                                    <label for="textinput8">
                                    </label>
                                    <input name="lname" id="textinput8" placeholder="Last name" value="" type="text" />
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup" data-mini="true">
                            <label for="textinput1">
                            </label>
                            <input name="username" id="textinput1" placeholder="Username" value="" type="text" />
                        </fieldset>
                    </div>
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup" data-mini="true">
                            <label for="textinput4">
                            </label>
                            <input name="password" id="textinput4" placeholder="Password" value="" type="password" />
                        </fieldset>
                    </div>
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup" data-mini="true">
                            <label for="textinput6">
                            </label>
                            <input name="confirm" id="textinput6" placeholder="Confirm password" value="" type="password" />
                        </fieldset>
                    </div>
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup" data-mini="true">
                            <label for="textinput5">
                            </label>
                            <input name="schoolemail" id="textinput5" placeholder="School email" value="" type="email" />
                        </fieldset>
                    </div>
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup" data-mini="true">
                            <label for="textinput2">
                            </label>
                            <input name="paypal" id="textinput2" placeholder="Paypal email" value="" type="email" />
                        </fieldset>
                    </div>
                    <div>
                        <a href="https://www.paypal.com" target="_blank" data-transition="fade">
                            Don't have PayPal? Click here!
                        </a>
                    </div>
                    <a href="#popuptest" class="ui-content" data-rel="popup" data-theme="b" data-position-to="window" data-role="button">TEST SUBMIT</a>
		      <input type="submit" data-theme="" value="Submit"  />
            		
		</form>
			
		<div data-role="popup" id="popuptest" href="#../popup/app.php" data-overlay-theme="a">
            		<div data-theme="d" data-role="header">
                		<h3>
                    			Confirm
                		</h3>
            		</div>
            		<div data-role="content">
                		<h2>
                    			Great! You're in!
                		</h2>
                		<a data-role="button" data-theme="b" href="../main/app.php">
                    			Check it out!
                		</a>
            		</div>
		</div>	
            </div>
        </div>
        <script>
            //App custom javascript
        </script>
    </body>
</html>