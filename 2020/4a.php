<?php
include '../header.inc.php';

$input = explode("\n\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2020/inputs/4a.txt'));

foreach ($input as $k => $v) {
	$input[$k] = str_replace("\n", " ", $v);
	preg_match_all("/([^,= ]+):([^,= ]+)/", $input[$k], $matches);
	$input[$k] = array_combine($matches[1], $matches[2]);
}

$requiredFields = [
	'byr' => '',
	'iyr' => '',
	'eyr' => '',
	'hgt' => '',
	'hcl' => '',
	'ecl' => '',
	'pid' => '',
];

$validPassport = 0;

foreach ($input as $passport) {
	if (empty(array_diff_key($requiredFields, $passport))) {
			$validPassport++;
	}
}

echo 'Valid Passports: ' . $validPassport;

include '../footer.inc.php';
