<?php
include '../header.inc.php';

$input = file($_SERVER['DOCUMENT_ROOT'] . '/2015/inputs/1a.txt', FILE_IGNORE_NEW_LINES);

$chars = str_split($input[0]);

$iteration = 1;
$position = 0;

foreach($chars as $char) {
	if ($char === '(') {
		$position++;
	} else {
		$position--;
	}

	if ($position === -1) {
		echo '<pre>First basement occurance: '; print_r($iteration); echo '</pre>';
		break;
	}

	$iteration++;
}

include '../footer.inc.php';
