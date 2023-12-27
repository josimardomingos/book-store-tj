#!/bin/sh

cd /var/www/html

# migration
php artisan migrate:refresh
