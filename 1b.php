<?php

$input = file($_SERVER['DOCUMENT_ROOT'] . '/inputs/1a.txt', FILE_IGNORE_NEW_LINES);

$iteration = 0;

foreach ($input as $int) {
	foreach ($input as $int2) {
		foreach ($input as $int3) {
			if ((int)$int + (int)$int2 + (int)$int3 === 2020) {
				echo $int . '<br>';
				echo $int2 . '<br>';
				echo $int3 . '<br>';
				echo ($int * $int2 * $int3) . '<br>';
				echo 'Iteration: ' . ($iteration) . '<br>';
				break 3;
			}
			$iteration++;
		}
	}
}
