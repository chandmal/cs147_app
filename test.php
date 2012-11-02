<?

echo timestamp_to_time(time());

function timestamp_to_time($time) {
	return date('D, g:ia', $time);
}

?>