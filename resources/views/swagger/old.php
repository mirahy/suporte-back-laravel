<?php
require("../vendor/autoload.php");
$openapi = \OpenApi\Generator::scan(['../app/Http/Controllers']);
header('Content-Type: application/x-yaml');
$openapi = json_encode($openapi);
file_put_contents('./openapi.json', $openapi);
?>

