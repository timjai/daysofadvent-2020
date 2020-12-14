<?php

include '../header.inc.php';

ini_set('max_execution_time', 300);
ini_set('memory_limit', -1);

$array = array_merge(explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2020/inputs/12a.txt')));

$facing = 90; // E
$x = 0;
$y = 0;

function move($action, $amount, &$x, &$y)
{
	switch ($action)
	{
		case 'N';
			$y -= $amount;
			break;
		case 'S';
			$y += $amount;
			break;
		case 'E';
			$x += $amount;
			break;
		case 'W';
			$x -= $amount;
			break;
	}
}

function turn($action, $amount, &$facing)
{
	switch ($action)
	{
		case 'L';
			$facing -= $amount;

			if ($facing < 0)
			{
				$facing += 360;
			}

			break;
		case 'R';
			$facing += $amount;

			if ($facing >= 360)
			{
				$facing -= 360;
			}
			break;
	}
}

function whatDirection($facing)
{
	switch ($facing)
	{
		case 0:
			return 'N';
		case 90:
			return 'E';
		case 180:
			return 'S';
		case 270:
			return 'W';
	}

	return false;
}

foreach ($array as $i => $instruction)
{
	$i++;
	preg_match('/^(\w)(\d*)$/', trim($instruction), $matches);

	list ($ignore, $action, $amount) = $matches;

	if (in_array($action, ['N', 'S', 'E', 'W']))
	{
		move($action, $amount, $x, $y);
	}
	elseif (in_array($action, ['R', 'L']))
	{
		turn($action, $amount, $facing);
	}
	elseif ($action === 'F')
	{
		move(whatDirection($facing), $amount, $x, $y);
	}
}

echo '<pre>p1: What is the Manhattan distance between that location and the ship\'s starting position? ';
debug(abs($x) + abs($y));
echo '</pre>';

include '../footer.inc.php';
