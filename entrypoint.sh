#!/bin/sh sh

composer install

#phpunit

bin/console server:run 0.0.0.0:8080
