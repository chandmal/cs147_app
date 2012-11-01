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
                <div data-role="navbar">
                    <ul>
                        <li>
                            <a href="new.php" data-theme="" rel="external">
                                To you
                            </a>
                        </li>
                        <li>
                            <a href="pending.php" data-theme="" rel="external">
                                From you
                            </a>
                        </li>
                        <li>
                            <a href="" data-theme="" class="ui-btn-active ui-state-persist">
                                Confirmed
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <script>
            //App custom javascript
        </script>
    </body>
</html>