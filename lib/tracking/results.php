<?php

$path = '/afs/ir.stanford.edu/users/h/o/holstein/cgi-bin/dev/cs147_app/lib';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require_once('db.php');

$trackings = mysql_query("SELECT * FROM tracking ORDER BY id desc");

?>

<table>
<tr>
<td>id</td>
<td>time</td>
<td>event</td>
<td>session_id</td>
</tr>

<? while($tracking = mysql_fetch_array($trackings)) { ?>
<tr>
<td><?= ($tracking['id']-1)/2 ?></td>
<td><?= $tracking['time'] ?></td>
<td><?= $tracking['event'] ?></td>
<td><?= $tracking['session_id'] ?></td>
</tr>
<? } ?>

</table>