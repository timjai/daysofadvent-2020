<?php

$input = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/inputs/3a.txt'));

$currentPos = 0;
$results = [];

$params = [
	['x' => 1, 'y' => 1],
	['x' => 3, 'y' => 1],
	['x' => 5, 'y' => 1],
	['x' => 7, 'y' => 1],
	['x' => 1, 'y' => 2],
];

foreach ($params as $paramKey => $param) {
	$results[$paramKey] = 0;
	$currentPos = $param['x'];
	for ($i = $param['y']; $i < count($input); $i += $param['y']) {

		$column = $currentPos;
		if ($column >= strlen($input[$i])) {
			$column = $column % strlen($input[$i]);
		}

		$strSplit = str_split($input[$i]);

		if ($strSplit[$column] === '#') {
			$results[$paramKey]++;
		}

		$currentPos += $param['x'];
	}
}

$treesHit = 1;

if (!empty($results)) {
	foreach ($results as $result) {
		$treesHit *= $result;
	}
}

echo '<pre>';
print_r($results);
echo '</pre>';

echo 'Trees Hit: ' . $treesHit;