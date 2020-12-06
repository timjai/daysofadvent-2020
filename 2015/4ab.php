<?php

include '../header.inc.php';

$input = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2015/inputs/4a.txt'));

$partA = false;
$partB = false;

foreach ($input as $code) {//
	for ($i = 10000; $i < 100000000; $i++) {
		$string = md5($code . $i);

		if (!$partA && substr($string, 0, 5) === '00000') {
			echo '<pre>Part A: The lowest iteration was: '; print_r($i); echo '</pre>';

			$partA = true;
		} elseif (!$partB && substr($string, 0, 6) === '000000') {
			echo '<pre>Part B: The lowest iteration was: '; print_r($i); echo '</pre>';

			$partB = true;
		}

		if ($partA && $partB) {
			break;
		}
	}
}

include '../footer.inc.php';
