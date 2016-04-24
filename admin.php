<?php session_start(); ?>
<html>

<head>
	<title>Site Admin</title>
	<script src="admin/codemirror/lib/codemirror.js"></script>
	<link rel="stylesheet" href="admin/codemirror/lib/codemirror.css">
	<script src="admin/codemirror/mode/javascript/javascript.js"></script>
	<script src="admin/codemirror/mode/xml/xml.js"></script>
	<script src="admin/codemirror/mode/css/css.js"></script>
	<script src="admin/codemirror/mode/htmlmixed/htmlmixed.js"></script>
	<script src="admin/codemirror/mode/clike/clike.js"></script>
	<script src="admin/codemirror/mode/php/php.js"></script>
	<link rel="stylesheet" type="text/css" href="/css/admin.css" />
</head>

<body>
<header>

</header>

<?php

include("./config.php");


$mysqli = new mysqli("localhost", $CONFIG['database_user'], $CONFIG['database_password'], "hackathon");

if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

$error_message = "";

if (array_key_exists('username', $_POST) && array_key_exists('password', $_POST)) {

	$username = $_POST['username'];
	$password = md5($_POST['password']);

	// Stop SQL injection
	$username = str_replace("'", "\'", $username);
	$username = str_replace('"', '\"', $username);

	$query = "SELECT * FROM users WHERE username='" . $username . "' AND password='" . $password . "'";

	$result = $mysqli->query($query);

	if (!$result) {
		 echo "Failed to query: (" . $mysqli->errno . ") " . $mysqli->error;
	}



	if ($result->num_rows > 0) {
		$_SESSION['logged_in'] = true;
		$_SESSION['user'] = $username;
	} else {
		$error_message =  "Invalid password. <br>Default username/password is admin/password";
	}

	// REMOVE BEFORE SITE GOES PUBLIC. FOR TESTING ONLY!
	if ($_POST['username'] == "test" && $_POST['password'] == "test") {
		$_SESSION['logged_in'] = true;
		$_SESSION['user'] = $username;
	}

}

if (!$mysqli->connect_errno) {
	$mysqli->close();
}


define('INCLUDED', true);
?>

<?php
/*
 *
 *
 */
//~ print_r( $_GET);


if (!array_key_exists('logged_in', $_SESSION) || (array_key_exists('logged_in', $_SESSION) && $_SESSION['logged_in'] == false)) : ?>
<div id="login-screen">
	Login:
	<form method="post" action="/admin.php">
		<table>
			<tr><td>Username: </td><td><input type="text" name="username"></td></tr>
			<tr><td>Password: </td><td><input type="password" name="password"></td></tr>
		</table>
		<input type="submit" value="Log In">


		<?php
		if ($error_message!="") {
			echo "<div id='error-message'>" . $error_message . "</div>";
		}
		?>


	</form>
</div>
<?php else : ?>

	<main>
		<section id="sidebar">
			<ul>
				<li><a href="admin.php?p=pages">Pages</a></li>
				<li><a href="admin.php?p=users">Users</a></li>
				<li><a href="admin.php?p=tools">Tools</a></li>
				<li><a href="admin.php?p=comments">Comments</a></li>
				<li><a href="admin.php">Admin Main</a></li>
				<li><a href="/index.php">Back to Site</a></li>
			</ul>
		</section>
		<section id="main">
			<?php if(!array_key_exists('p', $_GET)) : ?>
				Welcome <?php echo $_SESSION['user']; ?>
			<?php elseif(array_key_exists('p', $_GET) && $_GET['p']=='pages') : ?>
				<?php include("./admin/pages.php"); ?>
			<?php elseif(array_key_exists('p', $_GET) && $_GET['p']=='users') : ?>
				<?php include("./admin/users.php"); ?>
			<?php elseif(array_key_exists('p', $_GET) && $_GET['p']=='tools') : ?>
				<?php include("./admin/tools.php"); ?>
			<?php elseif(array_key_exists('p', $_GET) && $_GET['p']=='comments') : ?>
				<?php include("./admin/comments.php"); ?>
			<?php endif; ?>
		</section>
	</main>
<?php endif; ?>

<footer>


</footer>
</body>

</html>
