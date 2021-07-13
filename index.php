<?php

$name = $_GET['name'];

header('Content-Type', 'text/html');
http_response_code(200);
echo "hello $name";
