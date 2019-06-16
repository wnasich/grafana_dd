<?php
// Adjust and rename as config.php
require 'vendor/autoload.php';
require 'utils.php';

$config = [
	'baseUri' => 'http://[grafana_url]:[grafana_port]/api/',
	'apiKey' => '[api key]',
	'backupFolder' => 'backups',
];
