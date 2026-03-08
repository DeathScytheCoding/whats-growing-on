#!/bin/sh
set -eu

APP_USER="${APP_USER:-${WGO_USER:-wgo}}"
APP_UID="${APP_UID:-${WGO_UID:-${PUID:-1000}}}"
APP_GID="${APP_GID:-${WGO_GID:-${PGID:-1000}}}"
APP_DIR="/var/www/html"
WRITABLE_DIRS="${WRITABLE_DIRS:-$APP_DIR/data $APP_DIR/uploads}"

is_root() {
    [ "$(id -u)" -eq 0 ]
}

ensure_group() {
    if getent group "$APP_USER" >/dev/null 2>&1; then
        groupmod -o -g "$APP_GID" "$APP_USER" 2>/dev/null || true
    else
        groupadd -o -g "$APP_GID" "$APP_USER"
    fi
}

ensure_user() {
    if id -u "$APP_USER" >/dev/null 2>&1; then
        usermod -o -u "$APP_UID" -g "$APP_GID" "$APP_USER" 2>/dev/null || true
    else
        useradd -o -u "$APP_UID" -g "$APP_GID" -m -d "$APP_DIR" -s /usr/sbin/nologin "$APP_USER"
    fi
}

set_apache_user() {
    sed -ri "s/^export APACHE_RUN_USER=.*/export APACHE_RUN_USER=$APP_USER/" /etc/apache2/envvars
    sed -ri "s/^export APACHE_RUN_GROUP=.*/export APACHE_RUN_GROUP=$APP_USER/" /etc/apache2/envvars
}

fix_permissions() {
    for path in $WRITABLE_DIRS; do
        mkdir -p "$path"
        chown -R "$APP_UID:$APP_GID" "$path"
        chmod -R ug+rwX "$path"
    done
}

if is_root; then
    echo "[entrypoint] Running as root. Preparing runtime user '$APP_USER' ($APP_UID:$APP_GID)."
    ensure_group
    ensure_user
    set_apache_user
    fix_permissions

    echo "[entrypoint] Dropping privileges to '$APP_USER'."
    exec su-exec "$APP_USER" "$@"
else
	echo "[entrypoint] Running as non-root UID $(id -u). Skipping user/group management and chown."
    exec "$@"
fi
