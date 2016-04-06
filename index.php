<?php
include("./config.php");

if (array_key_exists('p', $_GET)) {
	$page = $_GET['p'];
} else {
	$page = 'home.php';
}

$TITLE = str_replace(".php", "", ucfirst($page));
?>
<html>
<?php include("./components/head.php"); ?>

<body>
<header>
	<?php include("./components/header.php"); ?>
</header>
<main>
<?php include("./pages/" . $page); ?>
</main>
<footer>
	<?php include("./components/footer.php"); ?>
</footer>
</body>

</html>
