<?php

include '../header.inc.php';

$input = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2020/inputs/9a.txt'));

$preamble = 25;

$checkList = array_slice($input, 0, $preamble);
$sumArray = array_slice($input, $preamble);
$invalidNumber = false;
foreach ($sumArray as $sum) {
	$found = false;
	foreach ($checkList as $k1 => $p1) {
		foreach ($checkList as $k2 => $p2) {
			if ($k1 === $k2) {
				continue;
			}

			if (($p1 + $p2) === (int)$sum) {

				$found = true;
			}
		}
	}

	if (!$found) {
		$invalidNumber = $sum;
		break;
	} else {
		array_shift($checkList);
		$checkList[] = $sum;
	}
}

echo '<pre>What is the first number that does not have this property? '; print_r($invalidNumber); echo '</pre>';

if (!empty($invalidNumber)) {
	$line = array_search($invalidNumber, $input);
	$dataset = array_slice($input, 0, $line);
	$chunkSize = count($dataset);
	$combinations = 0;
	$min = 0;
	$max = 0;
	while ($chunkSize > 2) {
		$i = 0;
		while($i < count($dataset)) {
			$split = array_slice($dataset, $i, $chunkSize);
			$sum = array_sum($split);

			if ((int)$sum === (int)$invalidNumber) {
				$min = min($split);
				$max = max($split);
				break 2;
			}

			$combinations++;
			$i++;
		}
		$chunkSize--;
	}
	
	echo '<pre>What is the encryption weakness in your XMAS-encrypted list of numbers? '; print_r($min + $max); echo '</pre>';
}

include '../footer.inc.php';
