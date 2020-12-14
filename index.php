<?php

include 'header.inc.php';

$directory = '.';

if (!is_dir('.')) {
	exit('Invalid directory path');
}

$years = [];
foreach (scandir($directory) as $year) {
	if ($year !== '.' && $year !== '..' && $year !== '.git' && is_dir($year)) {

		foreach (scandir($directory . '/' . $year) as $file) {
			if ($file !== '.' && $file !== '..' && !is_dir($year . '/' . $file) && $file !== 'index.php' && $file !== 'view_source.php' && $file !== 'common.inc.php') {
				$years[$year][] = $file;
			}
		}
	}
}

if (!empty($years)) {
	echo '<div class="row">';
	foreach ($years as $year => $files) {
		natsort($files);

		echo '<div class="col">';

		echo '<h2>' . $year . '</h2>';
		echo '<ul>';
		foreach ($files as $file) {
			echo '<li><a href="' . $year . '/' . $file . '">' . $file . '</a> [<a href="view_source.php?f=' . $year . '/' . $file . '">s</a>]</li>';
		}
		echo '</ul>';
		echo '</div>';
	}
	echo '</div>';

}

include 'footer.inc.php';

?>

