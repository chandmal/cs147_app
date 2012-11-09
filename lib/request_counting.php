<?php

function num_new_to_you_requests() {
	$time = time();
	$user_id = $_SESSION['user'];

	$to_you_requests = mysql_query("SELECT COUNT(*) FROM requests, rides, users WHERE requests.ride_id = rides.id AND requests.to_user=$user_id AND requests.confirmed=0 AND rides.leave_time > $time AND requests.confirmed = 0 AND users.id = requests.from_user AND is_new = 1 ORDER BY requests.id DESC");
	$to_you_requests = mysql_fetch_array($to_you_requests);
	$to_you_requests = $to_you_requests[0];
	return $to_you_requests;
}

function num_new_confirm_requests() {
	$time = time();
	$user_id = $_SESSION['user'];

	$confirmed_requests = 0;
	$confirmed_resource = mysql_query("SELECT DISTINCT requests.* FROM requests requests, rides rides WHERE (requests.to_user = $user_id OR requests.from_user = $user_id) AND requests.confirmed=1 AND (rides.return_time  + 3600 > $time) AND rides.id = requests.ride_id ORDER BY requests.id DESC");
	while($row = mysql_fetch_array($confirmed_resource)) {
		$ride = $row['ride_id'];
		$ride = mysql_query("SELECT * FROM rides WHERE id=$ride");
		$ride = mysql_fetch_array($ride);

		$user_is_driver = false;
		if($ride['type'] == 'driver' && $ride['user'] == $_SESSION['user']) $user_is_driver = true;
		if($ride['type'] == 'rider' && $ride['user'] != $_SESSION['user']) $user_is_driver = true;
		if($user_is_driver && $row['is_new_for_driver'] == 1) $confirmed_requests++;
		if(!$user_is_driver && $row['is_new_for_rider'] == 1) $confirmed_requests++;				
	}

	return $confirmed_requests;
}

?>