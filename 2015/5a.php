<?php

include '../header.inc.php';

$input = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2015/inputs/5a.txt'));

$niceStrings = 0;

foreach ($input as $code) {
	if (!hasVowels($code)) {
		continue;
	}

	if (!hasConsecutiveCharacters($code)) {
		continue;
	}


	if (hasInvalidParts($code)) {
		continue;
	}

	$niceStrings++;
}


echo '<pre>';
print_r('How many strings are nice?: ' . $niceStrings);
echo '</pre>';

function hasVowels($code) {
	$vowelsFound = 0;

	$codeArray = array_count_values(str_split($code));

	$vowelsArray = ['a','e','i','o','u'];

	foreach($vowelsArray as $vowel) {
		if (isset($codeArray[$vowel])) {
			$vowelsFound += $codeArray[$vowel];
		}
	}

	return $vowelsFound >= 3;
}

function hasConsecutiveCharacters($code) {
	$n = preg_match_all('/(.)\1+/', $code, $matches);

	return $n > 0;
}

function hasInvalidParts($code) {
	$checkFor = [
		'ab',
		'cd',
		'pq',
		'xy'
	];

	foreach($checkFor as $string) {
		if (stristr($code, $string) !== false) {
			return true;
		}
	}

	return false;
}

include '../footer.inc.php';
