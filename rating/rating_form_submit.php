<?

$path = '/afs/ir.stanford.edu/users/h/o/holstein/cgi-bin/dev/cs147_app/lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('db.php');

$your_user_id = $_POST['your_user_id'];
$their_user_id = $_POST['their_user_id'];

?>