<?php
include '../header.inc.php';

$input = file($_SERVER['DOCUMENT_ROOT'] . '/2020/inputs/2a.txt', FILE_IGNORE_NEW_LINES);
$validPasswords = 0;
foreach ($input as $expMe) {
	list($parameters, $character, $splitPassword) = explode(' ', $expMe);

	list($position1, $position2) = explode('-', $parameters);
	$character = str_replace(':', '', $character);
	$passwordSplit = str_split($splitPassword);

	if (
	($passwordSplit[$position1-1] === $character || $passwordSplit[$position2-1] === $character) &&
	!($passwordSplit[$position1-1] === $character && $passwordSplit[$position2-1] === $character)
	) {
		$validPasswords++;
	}
}

echo 'Valid: ' . $validPasswords;

include '../footer.inc.php';
