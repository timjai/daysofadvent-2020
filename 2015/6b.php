<?php

include '../header.inc.php';

$input = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2015/inputs/6a.txt'));

$width = 1000;
$height = 1000;
$array = [];

for ($w = 0; $w < $width; $w++)
{
	for ($h = 0; $h < $height; $h++)
	{
		$array[$w][$h] = 0;
	}
}

function countLights($array)
{
	$lights = 0;
	foreach ($array as $x)
	{
		foreach ($x as $y)
		{
			if ($y > 0)
			{
				$lights += $y;
			}
		}
	}

	return $lights;
}

foreach ($input as $task)
{
	preg_match('/^(.*?) (\d*),(\d*) through (\d*),(\d*)$/', trim($task), $matches);
	
	list ($ignore, $action, $x1, $y1, $x2, $y2) = $matches;

	for ($x = $x1; $x <= $x2; $x++)
	{
		for ($y = $y1; $y <= $y2; $y++)
		{
			if ($action === 'turn on') {
				$array[$x][$y] += 1;
			} elseif ($action === 'turn off' && $array[$x][$y] > 0) {
				$array[$x][$y] -= 1;
			} elseif ($action === 'toggle') {
				$array[$x][$y] += 2;
			} else {
				echo '<pre>'; debug($action); echo '</pre>'; die();
			}
		}
	}
}

echo '<pre>total brightness? '; print_r(countLights($array)); echo '</pre>';

include '../footer.inc.php';
