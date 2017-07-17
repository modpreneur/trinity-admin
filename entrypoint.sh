#!/bin/sh sh

composer install

#phpunit

htdocs/bin/console server:run 0.0.0.0:8080 --docroot=htdocs/web
