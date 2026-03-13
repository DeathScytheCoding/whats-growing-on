#!/bin/sh
set -e

PUID=${PUID:-1000}
PGID=${PGID:-1000}

groupmod -o -g "$PGID" wgo
usermod -o -u "$PUID" wgo

echo User UID: $(id -u wgo)
echo User GID: $(id -g wgo)

mkdir -p /run/php /run/nginx

chown -R $PUID:$PGID /var/www /run/php /run/nginx /etc/nginx /var/log/nginx /var/lib/nginx

php-fpm82 -F &

su-exec $PUID:$PGID nginx -g "daemon off;"
