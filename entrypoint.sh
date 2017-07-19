#!/bin/sh sh

composer install

#phpunit

phpstan analyse src/ --level=4

htdocs/bin/console server:run 0.0.0.0:8080 --docroot=htdocs/web
