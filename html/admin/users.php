<ul>
<?php

$connection = new mysqli("localhost", $CONFIG['database_user'], $CONFIG['database_password'], "hackathon");



if (array_key_exists('action', $_POST)) {
	if ($_POST['action'] == 'delete') {
		$query = "DELETE FROM users WHERE userid=" . $_POST['userid'];
		
		if ($connection->query($query) === TRUE) {
			echo "User deleted successfully";
		} else {
			echo "Failed to delete user";
		}
		
	} else if ($_POST['action'] == 'add') {
		$query = "INSERT INTO users (fullname, username, password) VALUES ('" . $_POST['new_fullname'] . "', '" . $_POST['new_username'] . "', '" . md5($_POST['new_password']) . "')";
		
		if ($connection->query($query)  === TRUE) {
			echo "User added successfully";
		} else {
			echo "Failed to add user";
		}
	}
}

$query = "SELECT * FROM users";

$result = $connection->query($query);

$user_count = $result->num_rows;

while($row = $result->fetch_array()) {
	//~ print_r($row);
	echo "<li>" . $row['fullname'] . " - " . $row['username'] . " <form method='post' action='" . $_SERVER['REQUEST_URI'] ."'><input type='hidden' name='userid' value='" . $row['userid'] . "' /><input type='hidden' name='action' value='delete' /><input type='submit' value='Delete' /></form></li>";
}

$result->free_result();

?>
</ul>

<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="adduser">
	<div>
		<input type="hidden" name="action" value="add" >
		Username: <input type="text" name="new_username" ><br/>
		Full Name: <input type="text" name="new_fullname" ><br/>
		Password: <input type="password" name="new_password" ><br/>
		<input type="submit" value="New User"><br/>
	</div>
</form>
