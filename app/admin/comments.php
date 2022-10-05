<?php
$connection = new mysqli($_CONFIG->database_host, $_CONFIG->database_user, $_CONFIG->database_password, $_CONFIG->database_name);

$query = "SELECT * FROM comments";

$result = $connection->query($query);

$comment_count = $result->num_rows;

?>

<?php if ($comment_count == 0) : ?>

There are no comments
<?php $result->free_result(); ?>

<?php else : ?>
<ul>
<?php
while($row = $result->fetch_array()) {
	//~ print_r($row);
	echo "<li> Comment #" . $row['commentid'] . ": by " . $row['name'] . " - " . $row['comment_text'] . "</li>";
}
$result->free_result();
?>
</ul>
<?php endif; ?>
