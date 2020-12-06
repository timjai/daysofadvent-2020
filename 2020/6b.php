<?php

include '../header.inc.php';

$input = explode("\n\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2020/inputs/6a.txt'));

$total = 0;
$rewriteAllThis = [];
foreach ($input as $questionsAnswered)
{
	$chars = array_keys(array_count_values(str_split(str_replace("\n", "", $questionsAnswered))));
	$persons = explode("\n", $questionsAnswered);

	$groupTotal = 0;
	foreach ($chars as $char)
	{
		foreach ($persons as $person)
		{
			if (!preg_match('/' . $char . '/', $person))
			{
				continue 2;
			}
		}

		$groupTotal++;
	}

	$total += $groupTotal;
}

echo '<pre>';
print_r('What is the sum of those counts?: ' . $total);
echo '</pre>';

include '../footer.inc.php';