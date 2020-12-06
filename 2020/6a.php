<?php

include '../header.inc.php';

$input = explode("\n\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2020/inputs/6a.txt'));

$total = 0;

foreach ($input as $questionsAnswered) {
	$split = str_split(str_replace("\n","", $questionsAnswered));
	$total +=count(array_count_values($split));
}

echo '<pre>';
print_r('What is the sum of those counts?: ' . $total);
echo '</pre>';

include '../footer.inc.php';
