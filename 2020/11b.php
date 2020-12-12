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
			} elseif ($seatStatus === '#' && $seatsAdjacent >= 5)
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
	if (topLeftOccupied($originalPlan, $row, $seat))
	{
		$seatsAdjacent++;
	}
	// check up
	if (topOccupied($originalPlan, $row, $seat))
	{
		$seatsAdjacent++;
	}
	// check up right
	if (topRightOccupied($originalPlan, $row, $seat))
	{
		$seatsAdjacent++;
	}
	// check left
	if (leftOccupied($originalPlan, $row, $seat))
	{
		$seatsAdjacent++;
	}
	// check right
	if (rightOccupied($originalPlan, $row, $seat))
	{
		$seatsAdjacent++;
	}
	// check down left
	if (bottomLeftOccupied($originalPlan, $row, $seat))
	{
		$seatsAdjacent++;
	}
	// check down
	if (bottomOccupied($originalPlan, $row, $seat))
	{
		$seatsAdjacent++;
	}
	// check down right
	if (bottomRightOccupied($originalPlan, $row, $seat))
	{
		$seatsAdjacent++;
	}

	return $seatsAdjacent;
}

function topLeftOccupied($originalPlan, $row, $seat)
{
	while (isset($originalPlan[$row - 1][$seat - 1]))
	{
		switch ($originalPlan[$row - 1][$seat - 1])
		{
			case 'L':
				return false;
				break;
			case '#':
				return true;
				break;
		}

		$row--;
		$seat--;
	}

	return false;
}

function topOccupied($originalPlan, $row, $seat)
{
	while (isset($originalPlan[$row - 1][$seat]))
	{
		switch ($originalPlan[$row - 1][$seat])
		{
			case 'L':
				return false;
				break;
			case '#':
				return true;
				break;
		}

		$row--;
	}

	return false;
}

function topRightOccupied($originalPlan, $row, $seat)
{
	while (isset($originalPlan[$row - 1][$seat + 1]))
	{
		switch ($originalPlan[$row - 1][$seat + 1])
		{
			case 'L':
				return false;
				break;
			case '#':
				return true;
				break;
		}

		$row--;
		$seat++;
	}

	return false;
}

function leftOccupied($originalPlan, $row, $seat)
{
	while (isset($originalPlan[$row][$seat - 1]))
	{
		switch ($originalPlan[$row][$seat - 1])
		{
			case 'L':
				return false;
				break;
			case '#':
				return true;
				break;
		}

		$seat--;
	}

	return false;
}

function rightOccupied($originalPlan, $row, $seat)
{
	while (isset($originalPlan[$row][$seat + 1]))
	{
		switch ($originalPlan[$row][$seat + 1])
		{
			case 'L':
				return false;
				break;
			case '#':
				return true;
				break;
		}

		$seat++;
	}

	return false;
}

function bottomLeftOccupied($originalPlan, $row, $seat)
{
	while (isset($originalPlan[$row + 1][$seat - 1]))
	{
		switch ($originalPlan[$row + 1][$seat - 1])
		{
			case 'L':
				return false;
				break;
			case '#':
				return true;
				break;
		}

		$row++;
		$seat--;
	}

	return false;
}

function bottomOccupied($originalPlan, $row, $seat)
{
	while (isset($originalPlan[$row + 1][$seat]))
	{
		switch ($originalPlan[$row + 1][$seat])
		{
			case 'L':
				return false;
				break;
			case '#':
				return true;
				break;
		}

		$row++;
	}

	return false;
}

function bottomRightOccupied($originalPlan, $row, $seat)
{
	while (isset($originalPlan[$row + 1][$seat + 1]))
	{
		switch ($originalPlan[$row + 1][$seat + 1])
		{
			case 'L':
				return false;
				break;
			case '#':
				return true;
				break;
		}

		$row++;
		$seat++;
	}

	return false;
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

echo '<pre>How many seats end up occupied? ';
print_r(countOccupiedSeats($seatingPlan['array']));
echo '</pre>';

include '../footer.inc.php';
