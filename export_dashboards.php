<?php
require 'config.php';

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
