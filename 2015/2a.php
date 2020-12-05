<?php
include '../header.inc.php';

$input = explode("\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2015/inputs/2a.txt'));

$total = 0;
foreach ($input as $present) {
	list($l, $w, $h) = explode('x', $present);

	$area1 = $l * $w;
	$area2 = $w * $h;
	$area3 = $h * $l;

	$slack = min([$area1, $area2, $area3]);

	$total += (2 * $area1) + (2 * $area2) + (2 * $area3) + $slack;
}

echo '<pre>Square feet of wrapping paper: ';
print_r($total);
echo '</pre>';

include '../footer.inc.php';
