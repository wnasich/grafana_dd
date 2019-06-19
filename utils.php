<?php
use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => $config['baseUri'],
    'timeout'  => 2.0,
    'headers' => [
		'Authorization' => 'Bearer ' . $config['apiKey']
    ],
]);

function slugify($text) {
	$text = preg_replace('~[^\pL\d]+~u', '-', $text);
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	$text = preg_replace('~[^-\w]+~', '', $text);
	$text = trim($text, '-');
	$text = preg_replace('~-+~', '-', $text);
	$text = strtolower($text);

	if (empty($text)) {
		return 'n-a';
	}

	return $text;
}
