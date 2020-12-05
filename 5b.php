<?php

include '5a.php';

$planeMap = [];

$input = !empty($input) ? $input : [];

foreach ($input as $boardingPass) {
	$row = (int)getRow($boardingPass);
	$column = (int)getColumn($boardingPass);
	$seatId = ($row * 8) + $column;

	if (!array_key_exists($row, $planeMap)) {
		$planeMap[$row] = [];
	}

	$planeMap[$row][$seatId] = $column;
}

ksort($planeMap);

// all went a bit tits up somewhere above
foreach ($planeMap as $row => $seat) {
	if (count($seat) === 6) {
		echo '<pre>'; print_r('------ The missing seat should be here -----'); echo '</pre>';
		ksort($seat);
		echo '<pre>';
		print_r($seat);
		echo '</pre>';
	}
}