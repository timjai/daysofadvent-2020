<?php

include '../header.inc.php';

$originalInput = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2020/inputs/8a.txt'));

$input = $originalInput;
$changedKeys = [];
$jumps = [];

while (empty($acc = runCode($input, $jumps))) {
	foreach($jumps as $jumpKey) {
		if (!in_array($jumpKey, $changedKeys) && preg_match('/(nop|jmp)/', $originalInput[$jumpKey], $matches))
		{
			$input = $originalInput;
			if ($matches[0] === 'nop') {
				$input[$jumpKey] = str_replace('nop', 'jmp', $input[$jumpKey]);
			} else {
				$input[$jumpKey] = str_replace('jmp', 'nop', $input[$jumpKey]);
			}

			$changedKeys[] = $jumpKey;

			break;

		}
	}

	$jumps = [];
}

debug('WINNER: ' . $acc);
die();

function runCode($input, &$jumps)
{
	$pos = 0;
	$acc = 0;
	$usedInstructions = [];
	$jumps = [];
	$i = 0;

// if it reaches this, it's broken
	while ($i <= 1000000)
	{
		if (!array_key_exists($pos, $input))
		{
			return $acc;
		} elseif (in_array($pos, $usedInstructions))
		{
			return false;
		}

		$i++;
		$instructions = explode(' ', $input[$pos]);
		$instruction = $instructions[0];

		preg_match('/(.){1}(\d*)/', $instructions[1], $matches);

		$pm = $matches[1];
		$am = $matches[2];

		array_unshift($jumps, $pos);

		$usedInstructions[] = $pos;

		switch ($instruction)
		{
			case 'nop':
				$pos++;
				break;
			case 'acc':
				if ($pm === '-')
				{
					$acc = $acc - $am;
				} else
				{
					$acc = $acc + $am;
				}

				$pos++;
				break;
			case 'jmp':
				if ($pm === '-')
				{
					$pos = $pos - $am;
				} else
				{
					$pos = $pos + $am;
				}

				break;

		}
	}
}

include '../footer.inc.php';
