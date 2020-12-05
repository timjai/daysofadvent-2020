<?php

include 'header.inc.php';

if (file_exists($_GET['f'])) {  show_source($_GET['f']); }

include 'footer.inc.php';
