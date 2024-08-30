<?php

require_once __DIR__ . '/../vendor/autoload.php';

$pcare = new Belokdwi\Bpjs\Pcare\Diagnosa();
$response = $pcare->getDiagnosa('A00', 0, 10);
var_dump($response);
