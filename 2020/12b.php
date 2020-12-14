<?php

include '../header.inc.php';

ini_set('max_execution_time', 300);
ini_set('memory_limit', -1);

$array = array_merge(explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2020/inputs/12a.txt')));

$facing = 90; // E
$x = 0;
$y = 0;
$wpx = 10;
$wpy = -1;

function move($action, $amount, &$wpx, &$wpy)
{
	switch ($action)
	{
		case 'N';
			$wpy -= $amount;
			break;
		case 'S';
			$wpy += $amount;
			break;
		case 'E';
			$wpx += $amount;
			break;
		case 'W';
			$wpx -= $amount;
			break;
	}
}

function turn($action, $amount, $x, $y, &$wpx, &$wpy)
{
	$rotate = ['x' => 0, 'y' => 0];

	switch ($action)
	{
		case 'L';
			$rotate = rotate($x, $y, 360 - $amount, ['x' => $wpx, 'y' => $wpy]);
			break;
		case 'R';
			$rotate = rotate($x, $y, $amount, ['x' => $wpx, 'y' => $wpy]);
			break;
	}

	$wpx = $rotate['x'];
	$wpy = $rotate['y'];
}

// https://stackoverflow.com/questions/2259476/rotating-a-point-about-another-point-2d
function rotate($cx, $cy, $angle, $point)
{
	$s = (float)sin(deg2rad($angle));
	$c = (float)cos(deg2rad($angle));

	// translate point back to origin:
	$point['x'] -= $cx;
	$point['y'] -= $cy;

	// rotate point
	$xnew = $point['x'] * $c - $point['y'] * $s;
	$ynew = $point['x'] * $s + $point['y'] * $c;

	// translate point back:
	$point['x'] = $xnew + $cx;
	$point['y'] = $ynew + $cy;

	return $point;
}

foreach ($array as $instruction)
{
	preg_match('/^(\w)(\d*)$/', trim($instruction), $matches);

	list ($ignore, $action, $amount) = $matches;

	if (in_array($action, ['N', 'S', 'E', 'W']))
	{
		move($action, $amount, $wpx, $wpy);
	} elseif (in_array($action, ['R', 'L']))
	{
		turn($action, $amount, $x, $y, $wpx, $wpy);
	} elseif ($action === 'F')
	{
		$distanceX = $wpx - $x;
		$distanceY = $wpy - $y;

		$x += $amount * $distanceX;
		$y += $amount * $distanceY;

		$wpx = $x + $distanceX;
		$wpy = $y + $distanceY;
	}
}

echo '<pre>p2: What is the Manhattan distance between that location and the ship\'s starting position? ';
debug(abs($x) + abs($y));
echo '</pre>';

include '../footer.inc.php';
