<?php
// Ensure we are running under the admin.php page
if(!defined('INCLUDED')){ die(); }


?>
<div id="command-list">
	<ul id="tool-list">
		<li><a href="/admin.php?p=tools&tool=df">Disk Usage</a></li>
		<li><a href="/admin.php?p=tools&tool=free">Memory Usage</a></li>
		<li><a href="/admin.php?p=tools&tool=phpinfo">PHP Info</a></li>
	</ul>
</div>

<div id="command-output">

<?php
if (array_key_exists('tool', $_GET) ){
	if ($_GET['tool'] == 'phpinfo') {
		phpinfo();
	} else {
		echo "<pre>";
		system($_GET['tool'] . ' -m');
		echo "</pre>";
	}
}
?>

</div>
