<?php

$input = file($_SERVER['DOCUMENT_ROOT'] . '/inputs/1a.txt', FILE_IGNORE_NEW_LINES);

$iteration = 0;

foreach ($input as $int) {
	foreach ($input as $int2) {
		if ((int)$int + (int)$int2 === 2020) {
			echo $int . '<br>';
			echo $int2 . '<br>';
			echo ($int * $int2) . '<br>';
			echo 'Iteration: ' . ($iteration) . '<br>';
			break 2;
		}
		$iteration++;
	}
}
