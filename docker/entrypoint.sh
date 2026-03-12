#!/bin/bash
set -e

# Get PUID/PGID
PUID=${PUID:-1000}
PGID=${PGID:-1000}

TARGET_USER=wgo
TARGET_GROUP=wgo

RUNTIME_UID="$(id -u)"
CURRENT_UID="$(id -u "$TARGET_USER")"
CURRENT_GID="$(id -g "$TARGET_USER")"

if [ "$RUNTIME_UID" = "0" ] || [ "$RUNTIME_UID" != "$CURRENT_UID" ]; then
    if [ "$RUNTIME_UID" != "0" ]; then
        echo "Warning: running as uid $RUNTIME_UID, expected $CURRENT_UID; cannot adjust without root."
        exec "$@"
    fi

    if [ "$PGID" != "$CURRENT_GID" ]; then
        groupmod -o -g "$PGID" "$TARGET_GROUP"
    fi
    if [ "$PUID" != "$CURRENT_UID" ]; then
        usermod -o -u "$PUID" "$TARGET_USER"
    fi

    chown -R "$PUID:$PGID" \
        /var/run/apache2 \
        /var/lock/apache2 \
        /var/log/apache2 \
        /var/www/html \
        /app/data \
        /app/uploads 2>/dev/null || true

    exec gosu "$PUID:$PGID" "$@"
fi

exec gosu "$PUID:$PGID" "$@"
