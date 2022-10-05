<?php 
if (array_key_exists('factsheet', $_GET) && $_GET['factsheet'] != "") {
    $path = "factsheets/" . $_GET['factsheet'];
    if (!file_exists($path)) {
        echo "Factsheet $path does not exist!";
    } else {
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"" . basename($_GET['factsheet']) . "\""); 
        readfile($path); 
    }
} else {
    echo "'factsheet' does not exist or is blank";
}
?>