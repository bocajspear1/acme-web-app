<?php
// File Uploads
if (count($_FILES) > 0 && array_key_exists('image_file', $_FILES)) {
	$name = $_FILES['image_file']['name'];
	$src = $_FILES['image_file']['tmp_name'];
	move_uploaded_file($src, $_SERVER['DOCUMENT_ROOT'] . "/images/$name");
	echo "<div>File uploaded</div>";
}

// Saving edits
if (array_key_exists('save', $_POST) && array_key_exists('edit', $_GET)) {
	$new_content = $_POST['save'];
	$page_edit =  $_GET['edit'];
	
	
	$status = file_put_contents("pages/" . $page_edit, $new_content);
	if ($status == false) {
		echo "<div>Failed to save file</div>";
	} else {
		echo "<div>Saved file</div>";
	}
}
?>
Edit
<?php
$pages = scandir("./pages");

echo "<ul>";
foreach ($pages as $page) {
	if ($page != "." && $page != "..") {
		echo "<li><a href='" . $_SERVER['REQUEST_URI'] . "&edit=". $page ."'>" . $page . "</a></li>";
	}
}
echo "</ul>";
?>

<div id="editor"></div>

<?php
if (array_key_exists('edit', $_GET)) {
	$page_edit =  $_GET['edit'];
	$page_contents = file_get_contents("pages/" . $page_edit);
	$page_contents = str_replace("\n", "\\n", $page_contents);
	$page_contents = str_replace("\r", "\\r", $page_contents);
	$page_contents = str_replace("\"", "\\\"", $page_contents);
} else {
	$page_edit = "";
	$page_contents = "";
}
?>
	
<?php if ($page_contents != "" && $page_contents == false) : ?>
	Could not load file <?php echo $page_edit; ?>
<?php elseif ($page_contents != "") : ?>
	
	<script>
		
	</script>
	
	<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" id="saveform">
		<div>
			<input type="hidden" name="save" id="save">
			<input type="submit" value="Save">
		</div>
	</form>
	
	<script>
		var myCodeMirror = CodeMirror(document.getElementById("editor"), {
		  value: "<?php echo $page_contents; ?>",
		  mode:  "php",
		  lineNumbers: true,
		  scrollbarStyle: "native"
		});
		
		var form = document.getElementById("saveform");
		
		form.addEventListener("submit", function (e) {
			e.preventDefault();
			
			document.getElementById("save").value = myCodeMirror.getValue();
			form.submit();
		});
		
		
	</script>
	
<?php endif; ?> 

Upload Images:
<form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>" enctype="multipart/form-data" >
	<div>
		<input type="file" name="image_file" ><br/>
		<input type="submit" value="Upload images"><br/>
	</div>
</form>
