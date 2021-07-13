<?php

require_once __DIR__ . '/vendor/autoload.php';
use Twitter\Http\Response;

$name =  $_GET['name'];

$response = new Response();

$response->setHeaders([
    'Content-Type', 'text/html'
]);

$response->setStatusCode(200);
$response->setContent("Bon dia $name");


$response->send();
