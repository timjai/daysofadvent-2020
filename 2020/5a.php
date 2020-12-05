<?php

include '../header.inc.php';

$input = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2020/inputs/5a.txt'));

function getRow($boardingPass)
{
	$currentFront = 1;
	$currentBack = 128;
	$midway = 64;

	$rowString = substr($boardingPass, 0, 7);
	$directions = str_split($rowString);

	foreach ($directions as $direction) {
		if ($direction === 'B') {
			$currentFront = $midway;
		} else {
			$currentBack = $midway;
		}

		$midway = ceil(($currentFront + ($currentBack - 1)) / 2);
	}

	return $currentFront <= $currentBack ? $currentFront : $currentBack;
}

function getColumn($boardingPass)
{
	$currentLeft = 1;
	$currentRight = 8;
	$midway = 4;

	$columnString = substr($boardingPass, 7, 3);
	$directions = str_split($columnString);

	foreach ($directions as $direction) {
		if ($direction === 'R') {
			$currentLeft = $midway;
		} else {
			$currentRight = $midway;
		}

		$midway = ceil(($currentLeft + ($currentRight - 1)) / 2);
	}

	return $currentLeft <= $currentRight ? $currentLeft : $currentRight;
}

$highest = 0;

foreach ($input as $boardingPass) {
	$row = (int)getRow($boardingPass);
	$column = (int)getColumn($boardingPass);
	$seatId = ($row * 8) + $column;

	$highest = $seatId > $highest ? $seatId : $highest;
}

echo '<pre>';
print_r('Highest: ' . $highest);
echo '</pre>';

include '../footer.inc.php';
