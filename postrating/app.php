<?

$path = '/afs/ir.stanford.edu/users/h/o/holstein/cgi-bin/dev/cs147_app/lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('db.php');

$your_user_id = $_POST['your_user_id'];
$their_user_id = $_POST['their_user_id'];

$you_user = mysql_query("SELECT * FROM users WHERE id = $your_user_id");
$you_user = mysql_fetch_array($you_user);

$they_user = mysql_query("SELECT * FROM users WHERE id = $their_user_id");
$they_user = mysql_fetch_array($they_user);

if($_POST['punctuality'] == -1) $they_user['thumbs_down']++;
if($_POST['punctuality'] == 0) $they_user['thumbs_neutral']++;
if($_POST['punctuality'] == 1) $they_user['thumbs_up']++;

if($_POST['would_again'] == -1) $they_user['thumbs_down']++;
if($_POST['would_again'] == 0) $they_user['thumbs_neutral']++;
if($_POST['would_again'] == 1) $they_user['thumbs_up']++;

mysql_query("UPDATE users SET thumbs_up = ".$they_user['thumbs_up']." WHERE id=$their_user_id");
mysql_query("UPDATE users SET thumbs_neutral = ".$they_user['thumbs_neutral']." WHERE id=$their_user_id");
mysql_query("UPDATE users SET thumbs_down = ".$they_user['thumbs_down']." WHERE id=$their_user_id");

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
                    Confirmation
                </h3>
                <a rel="external" data-role="button" href="../main/app.php" class="ui-btn-right">
                    Home
                </a>
            </div>
            <div data-role="content">
                <h2>
                    Thank you, <?= $you_user['first_name'] ?>!
                </h2>
                <h4>
                    Your responses help others know your experiences with <?= $they_user['first_name'] ?>.
                </h4>
                <a data-role="button" rel="external" href="../main/app.php">
                    Home
                </a>
            </div>
        </div>
        <script>
            //App custom javascript
        </script>
    </body>
</html>