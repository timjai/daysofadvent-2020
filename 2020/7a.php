<?php

include '../header.inc.php';

$input = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2020/inputs/7a.txt'));

$total = 0;

$bags = [];
$goldBags = [];

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
		preg_match('/^[[:digit:]] (.*?) bags?$/', $child, $matches);

		$children[] = $matches[1];

		if ($matches[1] === 'shiny gold')
		{
			$goldBags[] = $bag;
		}
	}

	$bags[$bag] = $children;
}

function loopUp(&$goldBags, $bags)
{
	$added = false;

	foreach ($goldBags as $goldBag)
	{
		foreach ($bags as $bag => $children)
		{
			if (in_array($goldBag, $children) && !in_array($bag, $goldBags))
			{
				$goldBags[] = $bag;
				$added = true;
			}
		}
	}

	if ($added)
	{
		return loopUp($goldBags, $bags);
	}
}

loopUp($goldBags, $bags);

echo '<pre>';
print_r('How many bag colors can eventually contain at least one shiny gold bag?: ' . count($goldBags));
echo '</pre>';

include '../footer.inc.php';
