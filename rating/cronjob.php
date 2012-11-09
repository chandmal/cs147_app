<?

$path = '/afs/ir.stanford.edu/users/h/o/holstein/cgi-bin/dev/cs147_app/lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('db.php');

$time = time();
$surveys = mysql_query("SELECT * FROM requests, rides WHERE requests.confirmed = 1 AND requests.paid = 1 AND requests.has_been_surveyed = 0 AND (rides.id = requests.ride_id AND rides.return_time < $time)");

while($survey = mysql_fetch_array($surveys))
{

$ride_id = $survey['ride_id'];
$ride = mysql_query("SELECT * FROM rides WHERE id=$ride_id");
$ride = mysql_fetch_array($ride);

$to_user_id = $survey['to_user'];
$to_user = mysql_query("SELECT * FROM users WHERE id=$to_user_id");
$to_user = mysql_fetch_array($to_user);

$from_user_id = $survey['from_user'];
$from_user = mysql_query("SELECT * FROM users WHERE id=$from_user_id");
$from_user = mysql_fetch_array($from_user);

sendSurvey($to_user, $from_user, $ride);
sendSurvey($from_user, $to_user, $ride);

$id = $survey[0];
mysql_query("UPDATE requests SET has_been_surveyed=1 WHERE id=$id");

}

function sendSurvey($recipient_user, $partner_user, $ride) {

//$to = $recipient_user['school_email'];

// subject
$subject = 'Share-A-Ride Survey';


$your_first_name = $recipient_user['first_name'];
$their_first_name = $partner_user['first_name'];

$your_user_id = $recipient_user['id'];
$their_user_id = $partner_user['id'];

// message
$message = <<<EOT
<html>
<body>
	<p><b>Hi, {$your_first_name}!</b></p>
	<p>This e-mail is to get some feedback about your most recent ride with {$their_first_name}.</p>
	<p>For the following questions, please select a thumbs up, neutral, or thumbs down for {$their_first_name}.</p>

	<form action="http://stanford.edu/~holstein/cgi-bin/dev/cs147_app/postrating/app.php" method="POST">

	<input type="hidden" name="your_user_id" value="{$your_user_id}">
	<input type="hidden" name="their_user_id" value="{$their_user_id}">

	<p>How punctual was {$their_first_name}?</p>
	<table><tr>
	<td><input type="radio" name="punctuality" value="1" /></td><td><img height="60px" src="http://stanford.edu/~holstein/cgi-bin/dev/cs147_app/icons/thumbup.png" /></td>
	<td width="8px"></td>
	<td><input type="radio" name="punctuality" value="0" /></td><td><img height="60px" src="http://stanford.edu/~holstein/cgi-bin/dev/cs147_app/icons/neutral.png" /></td>
	<td width="8px"></td>
	<td><input type="radio" name="punctuality" value="-1" /></td><td><img height="60px" src="http://stanford.edu/~holstein/cgi-bin/dev/cs147_app/icons/thumbdown.png" /></td>
	</tr></table>
	
	<p>Overall, would you ride with {$their_first_name} again?</p>
	<table><tr>
	<td><input type="radio" name="would_again" value="1" /></td><td><img height="60px" src="http://stanford.edu/~holstein/cgi-bin/dev/cs147_app/icons/thumbup.png" /></td>
	<td width="8px"></td>
	<td><input type="radio" name="would_again" value="0" /></td><td><img height="60px" src="http://stanford.edu/~holstein/cgi-bin/dev/cs147_app/icons/neutral.png" /></td>
	<td width="8px"></td>
	<td><input type="radio" name="would_again" value="-1" /></td><td><img height="60px" src="http://stanford.edu/~holstein/cgi-bin/dev/cs147_app/icons/thumbdown.png" /></td>
	</tr></table>

	<p><input type="submit" value="Submit" /></p>

	</form>

	<p>&nbsp;</p>
</body>
</html>
EOT;

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
$headers .= 'To: '.$recipient_user['first_name'].' '.$recipient_user['last_name'].' <'.$recipient_user['school_email'].'>' . "\r\n";
$headers .= 'From: Share-A-Ride <holstein@stanford.edu>' . "\r\n";

// Mail it
mail($to, $subject, $message, $headers);

}

?>