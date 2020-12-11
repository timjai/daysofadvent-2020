<?php

include '../header.inc.php';

ini_set('max_execution_time', 300);
ini_set('memory_limit', -1);

$array = array_merge([0], explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2020/inputs/10a.txt')));

$finalDestination = max($array);
sort($array);

function getJolty($array, $jolty)
{
	if (in_array($jolty + 1, $array))
	{
		return 1;
	}

	if (in_array($jolty + 2, $array))
	{
		return 2;
	}

	if (in_array($jolty + 3, $array))
	{
		return 3;
	}

	return false;
}

$jolt1 = 0;
$jolt3 = 1;

foreach ($array as $jolty)
{
	$getJolt = getJolty($array, $jolty);
	if ($getJolt === 1)
	{
		$jolt1++;
	} elseif ($getJolt === 3)
	{
		$jolt3++;
	}
}

echo '<pre>What is the number of 1-jolt differences multiplied by the number of 3-jolt differences? ';
print_r($jolt1 . ' * ' . $jolt3 . ' = ' . ($jolt1 * $jolt3));
echo '</pre>';

$cache = [];
function build($array, &$cache)
{
	$key = implode(',', $array);
	if (array_key_exists($key, $cache))
	{
		return $cache[$key];
	}

	$result = 1;
	for ($i = 1; $i < count($array) - 1; $i++)
	{
		if ($array[$i + 1] - $array[$i - 1] <= 3)
		{
			$x = array_merge([$array[$i - 1]], array_slice($array, $i + 1));
			$result += build($x, $cache);
		}
	}
	$cache[$key] = $result;

	return $result;
}

$combos = build($array, $cache);

echo '<pre>What is the total number of distinct ways you can arrange the adapters to connect the charging outlet to your device? '; print_r($combos); echo '</pre>';

include '../footer.inc.php';
