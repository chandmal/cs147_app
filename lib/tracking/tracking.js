function getPath() {
	var path = '' + window.location;
	var last_slash = path.lastIndexOf('/')
	var second_to_last_slash = path.lastIndexOf('/', last_slash - 1)
	var path = path.substr(second_to_last_slash + 1)
	path = path.split("php", 1);
	path = path[0] + "php";
	return path;
}


function recordEvent(event) {
	$.get('http://stanford.edu/~holstein/cgi-bin/dev/cs147_app/lib/tracking/tracking_event.php?event=' + event, function(data) {
	});
}

var path = getPath();
recordEvent(path + ' pageload')
$("html").click(function(event) {
	var path = getPath();


	if($(event.target).attr('id')) {
		recordEvent(path + ' click ' + $(event.target).attr('id'));
	} else if ($(event.target).parent().attr('id') != undefined) {
		recordEvent(path + ' click ' + $(event.target).parent().attr('id'));
	} else if ($(event.target).parent().parent().attr('id') != undefined) {
		recordEvent(path + ' click ' + $(event.target).parent().parent().attr('id'));
	} else if ($(event.target).parent().parent().parent().attr('id') != undefined) {
		recordEvent(path + ' click ' + $(event.target).parent().parent().parent().attr('id'));
	}
});