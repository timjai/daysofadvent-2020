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

		$passport = array_map("trim", $passport);

		if (!is_numeric($passport['byr']) | strlen($passport['byr']) !== 4 | $passport['byr'] < 1920 | $passport['byr'] > 2002) {
			continue;
		}
		if (!is_numeric($passport['iyr']) | strlen($passport['iyr']) !== 4 || $passport['iyr'] < 2010 | $passport['iyr'] > 2020) {
			continue;
		}
		if (!is_numeric($passport['eyr']) | strlen($passport['eyr']) !== 4 | $passport['eyr'] < 2020 | $passport['eyr'] > 2030) {
			continue;
		}

		$heightNumber = substr(trim($passport['hgt']), 0, -2);
		$heightMeasurement = substr(trim($passport['hgt']), -2);

		if (!is_numeric($heightNumber) | !in_array($heightMeasurement, ['cm', 'in'])) {
			continue;
		}

		if ($heightMeasurement === 'cm' && ($heightNumber < 150 | $heightNumber > 193)) {
			continue;
		}
		if ($heightMeasurement === 'in' && ($heightNumber < 59 | $heightNumber > 76)) {
			continue;
		}

		if (substr($passport['hcl'], 0, 1) !== '#' && !(ctype_xdigit(substr($passport['hcl'], 1)) && strlen(substr($passport['hcl'], 1)) === 6)) {
			continue;
		}

		if (!in_array($passport['ecl'], ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'])) {
			continue;
		}

		if (!is_numeric($passport['pid']) | strlen($passport['pid']) !== 9) {
			continue;
		}

		$validPassport++;
	}
}

echo 'Valid Passports: ' . $validPassport;

include '../footer.inc.php.inc.php';
