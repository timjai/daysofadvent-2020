<?php

include '../header.inc.php';

$input = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2020/inputs/8a.txt'));

$pos = 0;
$acc = 0;
$usedInstructions = [];
$iterations = 0;

// if it reaches this, it's broken
while($iterations <= 1000000)
{
	if (in_array($pos, $usedInstructions))
	{
		echo '<pre>';
		debug('What value is in the accumulator?: ' . $acc);
		echo '</pre>';
		die();
	}

	$instructions = explode(' ', $input[$pos]);
	$instruction = $instructions[0];
	preg_match('/(.){1}(\d*)/', $instructions[1], $matches);

	$pm = $matches[1];
	$am = $matches[2];

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

include '../footer.inc.php';
