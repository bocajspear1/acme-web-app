<?php session_start(); ?>
<html>

<head>
	<title>Test</title>
  <style>
  iframe {
    width:90%;
    height: 500px;
  }
  </style>
</head>

<body>
This page ensures that the app works correctly.

<?php error_reporting(E_ALL); ?>

<ul>
  <li>
    MySQLi library should be installed. No errors should appear below.

    <?php
    include("./config.php");

    $mysqli = new mysqli("localhost", $CONFIG['database_user'], $CONFIG['database_password'], "hackathon");
    ?>
  </li>
  <li>
    The following page should appear without errors. <br />
    <iframe src="admin.php">
      Frames not supported
    </iframe>
  </li>
  <li>
    The following page should appear without errors. <br />
    <iframe src="admin.php?p=pages&edit=about.php">
      Frames not supported
    </iframe>
  </li>
</ul>

</body>

</html>
