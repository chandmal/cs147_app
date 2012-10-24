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
                <h3>
                    Settings
                </h3>
                <a data-role="button" data-rel="back" href="#page1" class="ui-btn-left">
                    Back
                </a>
		  <a data-role="button" data-rel="" href="../login/app.php" class="ui-btn-right">
                    Log Out
                </a>
            </div>
            <div data-role="content">
                <h4>
                    Change your settings:
                </h4>
                <form action="" method="post">
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup" data-mini="true">
                            <label for="textinput2">
                                Change Password:
                            </label>
                            <input name="check" id="textinput2" placeholder="Old Password" value="" type="password" />
                        </fieldset>
                    </div>
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup" data-mini="true">
                            <label for="textinput3">
                            </label>
                            <input name="newpassword" id="textinput3" placeholder="New Password" value="" type="password" />
                        </fieldset>
                    </div>
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup" data-mini="true">
                            <label for="textinput4">
                            </label>
                            <input name="confirmpassword" id="textinput4" placeholder="Confirm Password" value="" type="password" />
                        </fieldset>
                    </div>
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup">
                            <label for="textinput5">
                                Change email:
                            </label>
                            <input name="newemail" id="textinput5" placeholder="New Email" value="" type="email" />
                        </fieldset>
                    </div>
                    <input type="submit" data-theme="b" value="Save Changes" />
                </form>
            </div>
        </div>
        <script>
            //App custom javascript
        </script>
    </body>
</html>