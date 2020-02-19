<?php
$connection = new mysqli("localhost", $CONFIG['database_user'], $CONFIG['database_password'], "hackathon");

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
