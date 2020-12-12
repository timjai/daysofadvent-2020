<?php

include '../header.inc.php';

ini_set('max_execution_time', 300);
ini_set('memory_limit', -1);

$array = array_merge(explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2020/inputs/11a.txt')));

$seatingPlan = ['changes' => true, 'array' => []];
foreach ($array as $row => $seatsRow)
{
	$seats = str_split($seatsRow, 1);
	$seatingPlan['array'][$row] = $seats;
}

function run($array)
{
	$originalPlan = $array;
	$changes = 0;

	foreach ($array as $row => $rowArray)
	{
		foreach ($rowArray as $seat => $seatStatus)
		{
			$seatsAdjacent = checkSeats($originalPlan, $row, $seat);

			if ($seatStatus === 'L' && $seatsAdjacent === 0)
			{
				$array[$row][$seat] = '#';
				$changes++;
			} elseif ($seatStatus === '#' && $seatsAdjacent >= 4)
			{
				$array[$row][$seat] = 'L';
				$changes++;
			}
		}
	}

	return ['changes' => $changes, 'array' => $array];
}

function checkSeats($originalPlan, $row, $seat)
{
	$seatsAdjacent = 0;

	// check up left
	if (isset($originalPlan[$row - 1][$seat - 1]) && $originalPlan[$row - 1][$seat - 1] === '#')
	{
		$seatsAdjacent++;
	}
	// check up
	if (isset($originalPlan[$row - 1][$seat]) && $originalPlan[$row - 1][$seat] === '#')
	{
		$seatsAdjacent++;
	}
	// check up right
	if (isset($originalPlan[$row - 1][$seat + 1]) && $originalPlan[$row - 1][$seat + 1] === '#')
	{
		$seatsAdjacent++;
	}
	// check left
	if (isset($originalPlan[$row][$seat - 1]) && $originalPlan[$row][$seat - 1] === '#')
	{
		$seatsAdjacent++;
	}
	// check right
	if (isset($originalPlan[$row][$seat + 1]) && $originalPlan[$row][$seat + 1] === '#')
	{
		$seatsAdjacent++;
	}
	// check down left
	if (isset($originalPlan[$row + 1][$seat - 1]) && $originalPlan[$row + 1][$seat - 1] === '#')
	{
		$seatsAdjacent++;
	}
	// check down
	if (isset($originalPlan[$row + 1][$seat]) && $originalPlan[$row + 1][$seat] === '#')
	{
		$seatsAdjacent++;
	}
	// check down right
	if (isset($originalPlan[$row + 1][$seat + 1]) && $originalPlan[$row + 1][$seat + 1] === '#')
	{
		$seatsAdjacent++;
	}

	return $seatsAdjacent;
}

function countOccupiedSeats($array)
{
	$count = 0;
	foreach ($array as $row)
	{
		foreach ($row as $seat)
		{
			if ($seat === '#')
			{
				$count++;
			}
		}
	}

	return $count;
}

function printSeatingPlan($array)
{
	$html = '';
	foreach ($array as $row)
	{
		foreach ($row as $seat)
		{
			$html .= $seat;
		}
		$html .= "<br>";
	}

	print_r('<code>' . $html . '</code><br><br>');
}

printSeatingPlan($seatingPlan['array']);

$changes = true;

while ($changes)
{
	$seatingPlan = run($seatingPlan['array']);

	echo '<pre>';
	print_r($seatingPlan['changes']);
	echo '</pre>';

	printSeatingPlan($seatingPlan['array']);

	$changes = $seatingPlan['changes'];
}

echo '<pre>How many seats end up occupied? '; print_r(countOccupiedSeats($seatingPlan['array'])); echo '</pre>';

include '../footer.inc.php';
