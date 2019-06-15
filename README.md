# grafana_dd #
Grafana dashboard download

Intended for downloading of dashboards definitions and allow to do version control with external tool rather that the grafana internal versioning system.

## Requiriments ##
PHP 7.2+

## Install ##
Clone this repository

Execute `composer install`

Copy `config-default.php` to `config.php` and edit configurations

## Usage ##
`php -f export_dashboards.php`

