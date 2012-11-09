<?

header('Location: ../map/app.php');
exit;

?>

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
                    Directions
                </h3>
                <a data-role="button" data-rel="back" href="#page1" class="ui-btn-left">
                    Back
                </a>
            </div>
            <div data-role="content">
                <h2>
                    How To Use the Map:
                </h2>
                <h4>
			<ul>
				<li>To view an existing destination, tap on an existing marker on the map.</li><br/>
				<li>To create a new destination, tap where you want to go.</li><br/>
				<li>To view your own destinations, tap on your green destination markers.</li>
			</ul>
                </h4>

		  <a href="../map/app.php" rel="external" data-role="button" data-theme="b"> Proceed </a>
            </div>
        </div>
        <script>
            //App custom javascript
        </script>
    </body>
</html>