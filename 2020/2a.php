<?php
include '../header.inc.php';

$input = file($_SERVER['DOCUMENT_ROOT'] . '/2020/inputs/2a.txt', FILE_IGNORE_NEW_LINES);
$validPasswords = 0;
foreach ($input as $expMe) {
	list($parameters, $character, $splitPassword) = explode(' ', $expMe);

	list($from, $to) = explode('-', $parameters);
	$character = str_replace(':', '', $character);
	$passwordSplit = str_split($splitPassword);
	$password = [
		$character => 0
	];

	foreach($passwordSplit as $char) {
		if (!array_key_exists($char, $password)) {
			$password[$char] = 0;
		}

		$password[$char]++;
	}

	if ($password[$character] >= $from && $password[$character] <= $to) {
		$validPasswords++;
	}

}

echo 'Valid: ' . $validPasswords;
include '../footer.inc.php';
