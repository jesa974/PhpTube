<?php

$buffer = '<?xml version="1.0"?>';
$buffer .= "<reponse><message>Champ incomplet</message></reponse>";

header('Content-Type: text/xml');
echo $buffer;
