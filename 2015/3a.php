<?php
include '../header.inc.php';

$input = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2015/inputs/3a.txt'));

$total = 0;
foreach ($input as $directionString) {
	$directions = str_split($directionString);

	$map = ['0x0' => 1];
	$currentX = 0;
	$currentY = 0;

	foreach ($directions as $direction) {
		if ($direction === '>') {
			$currentX++;
		} elseif ($direction === '<') {
			$currentX--;
		} elseif ($direction === '^') {
			$currentY++;
		} elseif ($direction === 'v') {
			$currentY--;
		}

		if (!array_key_exists($currentX . 'x' . $currentY, $map)) {
			$map[$currentX . 'x' . $currentY] = 0;
		}

		$map[$currentX . 'x' . $currentY]++;
	}
}

echo '<pre>Houses receive at least one present: ';
print_r(count($map));
echo '</pre>';

include '../footer.inc.php';
