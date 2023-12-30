#!/bin/bash

php artisan key:generate
php artisan optimize:clear

exec php-fpm
