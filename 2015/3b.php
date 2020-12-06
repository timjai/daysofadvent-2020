<?php
include '../header.inc.php';

$input = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2015/inputs/3a.txt'));

$total = 0;
foreach ($input as $directionString) {
	$directions = str_split($directionString);

	$map = ['0x0' => 1];
	$currentX = 0;
	$currentY = 0;
	$currentRoboX = 0;
	$currentRoboY = 0;

	$current = 'Santa';

	foreach ($directions as $direction) {
		$varX = ($current === 'Santa') ? 'currentX' : 'currentRoboX';
		$varY = ($current === 'Santa') ? 'currentY' : 'currentRoboY';

		if ($direction === '>') {
			$$varX++;
		} elseif ($direction === '<') {
			$$varX--;
		} elseif ($direction === '^') {
			$$varY++;
		} elseif ($direction === 'v') {
			$$varY--;
		}

		if (!array_key_exists($$varX . 'x' . $$varY, $map)) {
			$map[$$varX . 'x' . $$varY] = 0;
		}

		$map[$$varX . 'x' . $$varY]++;

		$current = ($current === 'Santa') ? 'Robo' : 'Santa';
	}
}

echo '<pre>Houses receive at least one present: ';
print_r(count($map));
echo '</pre>';

include '../footer.inc.php';
