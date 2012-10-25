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
                <a data-role="button" href="../settings/app.php" data-icon="gear" data-iconpos="left" class="ui-btn-right">
                    Settings
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
                    Hi, [name]!
                </h2>
                <form action="">
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup" data-type="horizontal">
                            <legend>
                                I am a:
                            </legend>
                            <input id="radio3" name="" value="driver" type="radio" />
                            <label for="radio3">
                                Driver
                            </label>
                            <input id="radio4" name="" value="rider" type="radio" />
                            <label for="radio4">
                                Rider
                            </label>
                        </fieldset>
                    </div>
                    <input type="submit" data-theme="b" value="Where to?" />
                </form>
		<a data-role="button" data-theme="b" href="../requests/new.php" >
			Check requests
		</a>
            </div>
        </div>
        <script>
            //App custom javascript
        </script>
    </body>
</html>