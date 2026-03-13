#!/bin/sh
set -e

mkdir -p /run/php /run/nginx

php-fpm82 -F &

exec nginx -g "daemon off;"
