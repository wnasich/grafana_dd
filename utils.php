<?php
use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => $config['baseUri'],
    'timeout'  => 2.0,
    'headers' => [
		'Authorization' => 'Bearer ' . $config['apiKey']
    ],
]);