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
			if ($y === 1)
			{
				$lights++;
			}
		}
	}

	return $lights;
}

foreach ($input as $task)
{
	$changeTo = null;

	preg_match('/^(.*?) (\d*),(\d*) through (\d*),(\d*)$/', trim($task), $matches);
	
	list ($ignore, $action, $x1, $y1, $x2, $y2) = $matches;

	if ($action === 'turn on') {
		$changeTo = 1;
	} elseif ($action === 'turn off') {
		$changeTo = 0;
	}
	
	for ($x = $x1; $x <= $x2; $x++)
	{
		for ($y = $y1; $y <= $y2; $y++)
		{
			if ($changeTo !== null) {
				$array[$x][$y] = $changeTo;
			} else {
				$array[$x][$y] = ($array[$x][$y] === 1) ? 0 : 1;
			}
		}
	}
}

echo '<pre>how many lights are lit? '; print_r(countLights($array)); echo '</pre>';

include '../footer.inc.php';
