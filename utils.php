<?php
use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => $config['baseUri'],
    'timeout'  => 20,
    'headers' => [
		'Authorization' => 'Bearer ' . $config['apiKey']
    ],
]);