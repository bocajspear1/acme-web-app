<?php


if (array_key_exists('comment_text', $_POST) && array_key_exists('comment_name', $_POST) ) {
	$connection = new mysqli("localhost", $CONFIG['database_user'], $CONFIG['database_password'], "hackathon");

	$query = "INSERT INTO comments (name, comment_text) VALUES ('" . $_POST['comment_name'] ."', '" . $_POST['comment_text'] . "')";

	if ($connection->query($query) === TRUE) {
		echo "Thanks for your comments!<br>";
	} else {
		echo "Uh oh, something went wrong...<br>";
	}
}
?>
Write us a comment!

<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="comment">
	<div>
		Name: <input type="text" name="comment_name" ><br/>
		Comment: <br><textarea name="comment_text" form="comment" id="comment-box">Enter comment here...</textarea><br>
		<input type="submit" value="Comment!"><br/>
	</div>
</form>

