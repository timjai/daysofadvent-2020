<?php

include '../header.inc.php';

$input = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2015/inputs/5a.txt'));

$niceStrings = 0;

foreach ($input as $code)
{
	if (!hasPairs($code))
	{
		continue;
	}

	if (!hasSplitThingy($code))
	{
		continue;
	}

	$niceStrings++;
}

echo '<pre>';
print_r('How many strings are nice?: ' . $niceStrings);
echo '</pre>';

function hasPairs($code)
{
	// capture two chars - match again unlimited times using data of first capture
	return preg_match('/(..).*\1/', $code);
}

function hasSplitThingy($code)
{
	// capture anything - anything - data of first capture
	return preg_match('/(.).\1/', $code);
}

include '../footer.inc.php';
