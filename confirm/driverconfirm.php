<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>
		Confirmation
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
                <a data-role="button" href="../main/app.php" class="ui-btn-right">
                    Menu
                </a>
                <h3>
                    Confirmation
                </h3>
                <a data-role="button" data-rel="back" href="#page1" class="ui-btn-left">
                    Back
                </a>
            </div>
            <div data-role="content">
                <h2>
                    Thanks for confirming. 
                </h2>
		  <h4>
		      Sit tight and wait for payment confirmation. When payment has been received, we'll let you know.
		  </h4>
                <h4>
                    What do you want to do next?
                </h4>
                <a data-role="button" data-theme="b" rel="external" href="../map/app.php">
                    Choose more destinations
                </a>
                <a data-role="button" data-theme="b" href="../requests/new.php">
                    Go request menu
                </a>
                <a data-role="button" rel="external" data-theme="b" href="../main/app.php">
                    Go to main menu
                </a>
            </div>
        </div>
        <script>
            //App custom javascript
        </script>
    </body>
</html>