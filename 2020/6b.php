<?php

include '../header.inc.php';

$input = explode("\n\n", file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/2020/inputs/6a.txt'));

$total = 0;
$rewriteAllThis = [];
foreach ($input as $questionsAnswered)
{
	$responses = explode("\n", $questionsAnswered);
	$chars = [];
	$persons = [];
	foreach ($responses as $personsResponse)
	{
		$chars = array_merge($chars, str_split($personsResponse));
		$persons[] = $personsResponse;
	}

	$chars = array_unique($chars);
	$total = 0;
	foreach($chars as $char) {
		$hasChar = true;
		foreach($persons as $person) {

			if (!in_array($char, str_split($person))) {
				$hasChar = false;
			}
}
		if ($hasChar) {
			$total++;
		}
	}

	$rewriteAllThis[] = $total;
}

echo '<pre>';
print_r('What is the sum of those counts?: ' . array_sum($rewriteAllThis));
echo '</pre>';

include '../footer.inc.php';


/*
 * 	$responses = explode("\n", $questionsAnswered);
	foreach($responses as $personsResponse) {

		$answers = array_unique(array_keys(array_count_values(str_split($personsResponse))));
		foreach ($answers as $answer) {
			$toSum[$answer] = chr($answer);
		}
		echo '<pre>'; debug($answers); echo '</pre>';
	}
	$split = str_split($questionsAnswered);
//	echo '<pre>'; debug($questionsAnswered); echo '</pre>'; die();
	$total +=count(array_count_values($split));

	die();
 */