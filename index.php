<?php

$directory = '.';

if (!is_dir('.')) {
	exit('Invalid directory path');
}

$files = array();
foreach (scandir($directory) as $file) {
	if ($file !== '.' && $file !== '..' && !is_dir($file) && $file !== 'index.php' && $file !== 'view_source.php') {
		$files[] = $file;
	}
}

if (!empty($files)) {
	echo '<ul>';
	foreach ($files as $file) {
		echo '<li><a href="'.$file.'">'.$file.'</a> [<a href="view_source.php?f='.$file.'">s</a>]</li>';
	}
	echo '</ul>';
}
?>