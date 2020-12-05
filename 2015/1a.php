<?php
include '../header.inc.php';

$input = file($_SERVER['DOCUMENT_ROOT'] . '/2015/inputs/1a.txt', FILE_IGNORE_NEW_LINES);

$charList = count_chars($input[0]);

echo '<pre>'; print_r($charList[40] - $charList[41]); echo '</pre>';

include '../footer.inc.php';
