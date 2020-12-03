<?php

$input = file($_SERVER['DOCUMENT_ROOT'] . '/inputs/3a.txt', FILE_IGNORE_NEW_LINES);

$currentPos = 0;
$treesHit = 0;

foreach ($input as $k => $expMe) {
	if ($k === 0) {
		$currentPos = 3;
		continue;
	}

	$column = $currentPos;
	if ($column >= strlen($input[$k])) {
		$column = $column % strlen($input[$k]);
	}

	$strSplit = str_split($expMe);

	if ($strSplit[$column] === '#') {
		$treesHit++;
	}

	$currentPos += 3;
}

echo 'Trees Hit: ' . $treesHit;
