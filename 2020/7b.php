<?php

include '../header.inc.php';

$input = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2020/inputs/7a.txt'));

$total = 0;

$bags = [];
$bagCount = [];

foreach ($input as $rule)
{
	$test = preg_match_all('/^(.*?) bags contain (.*?).$/', $rule, $matches);

	$bag = $matches[1][0];
	$expChildren = explode(', ', $matches[2][0]);

	$children = [];

	foreach ($expChildren as $child)
	{
		if ($child === 'no other bags')
		{
			continue;
		}
		preg_match('/^(.*?) bags?$/', $child, $matches);

		$explodeMatches = explode(' ', $matches[1], 2);
		$children[$explodeMatches[1]] = $explodeMatches[0];
	}

	$bags[$bag] = $children;
}

function getSum($bags, $bag) {
	$values = [];
	foreach($bags[$bag] as $child => $num)
	{
		$values[] = $num * getSum($bags, $child);
	}

	return 1 + array_sum($values);
}

$sum = getSum($bags, 'shiny gold')-1;

echo '<pre>';
print_r('How many individual bags are required inside your single shiny gold bag?: ' . $sum);
echo '</pre>';

include '../footer.inc.php';
