<?php
include '../header.inc.php';

$input = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2015/inputs/2a.txt'));

$total = 0;
foreach ($input as $present) {
	$dimensions = explode('x', $present);

	sort($dimensions);

	$removed = array_pop($dimensions);

	// ribbon
	$total += $dimensions[0] + $dimensions[0] + $dimensions[1] + $dimensions[1];
	// bow
	$total += $dimensions[0] * $dimensions[1] * $removed;
}

echo '<pre>Feet of ribbon: ';
print_r($total);
echo '</pre>';

include '../footer.inc.php';
