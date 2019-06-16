<?php
require 'config.php';

/*
curl -H "Authorization: Bearer eyJrIjoiMzBuOTlJcjVXSHNLNmtnSkpXUkJrTUtJVTdVa1k3VjUiLCJuIjoiYXBpX2FjY2VzcyIsImlkIjoxfQ==" \
	http://ec2-18-218-250-121.us-east-2.compute.amazonaws.com:3000/api/dashboards/home
*/
use GuzzleHttp\Client;

$client = new Client([
    'base_uri' => $config['baseUri'],
    'timeout'  => 2.0,
    'headers' => [
    	'Authorization' => 'Bearer ' . $config['apiKey']
    ],
]);

$backupFolder = $config['backupFolder'];
if (!file_exists($backupFolder)) {
	mkdir($backupFolder);
}
$backupFolder .= DIRECTORY_SEPARATOR;

$dashboards = json_decode((string) $client->get('search')->getBody(), true);

foreach ($dashboards as $dashboard) {
	$dashboardSlug = slugify($dashboard['title']);
	$toFile = $backupFolder . $dashboardSlug . '.json';
	echo "Exporting dashboard to file {$toFile}\n";
	$fp = fopen($toFile, 'w');

	$dashboardDef = (string) $client->get('dashboards/uid/' . $dashboard['uid'])->getBody();
	$dashboardDef = json_decode($dashboardDef);
	$dashboardDef = json_encode($dashboardDef, JSON_PRETTY_PRINT);
	fwrite($fp, $dashboardDef);
}
