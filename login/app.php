<!DOCTYPE html>
<html>
    <head>
	<title>Share-A-Ride</title>

       <meta charset="utf-8" />
	<meta name="apple-mobile-web-app-capable" content="yes">
 	<meta name="apple-mobile-web-app-status-bar-style" content="black">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<link rel="stylesheet" href="http://jquerymobile.com/demos/1.2.0-alpha.1/css/themes/default/jquery.mobile-1.2.0-alpha.1.css" />
       <link rel="stylesheet" href="my.css" />
	<link rel="apple-touch-icon" href="appicon2.png" />
	<link rel="apple-touch-startup-image" href="startup2.png">

       <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
       <script src="http://jquerymobile.com/demos/1.2.0-alpha.1/js/jquery.mobile-1.2.0-alpha.1.js"></script>
       <script src="my.js"></script>
    </head>
    <body>
        <!-- Home -->
        <div data-role="page" id="page1">
            <div data-theme="a" data-role="header">
                <h3>
                    Login
                </h3>
                <a data-role="button" data-ajax="false" href="../signup/app.php" class="ui-btn-right">
                    New? Sign up!
                </a>
            </div>
            <div data-role="content">
                <h2>
                    Welcome back!
                </h2>
                <form action="" id="login_form">
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup">
                            <label for="textinput1">
                            </label>
                            <input name="username" id="username" placeholder="Username" value="" type="text" />
                        </fieldset>
                    </div>
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup">
                            <label for="textinput2">
                            </label>
                            <input name="password" id="password" placeholder="Password" value="" type="password" />
                        </fieldset>
                    </div>
                    <input type="button" data-theme="b" value="Submit" onclick="login()" />
                </form>
            </div>
        </div>
        <script>
		function login() {
			$.mobile.loading( 'show', {
				text: 'Logging in...',
				textVisible: true,
				theme: 'a'
			});

			$.ajax({
  				type: 'POST',
				url: 'login.php',
				data: $("#login_form").serialize(),
				async: false
			}).done(function(data) {
				data = eval(data);
				$.mobile.loading('hide');
				if(data[0] == 1) {
					document.location = "../main/app.php";
				} else {
					alert(data[1]);
				}
			});
		}
		
		$("#password").keydown(function(event) {
			if(event.which == 13) {
				login();
			}
		});
	
        </script>
    </body>
</html>
