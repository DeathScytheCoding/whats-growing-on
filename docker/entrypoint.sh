#!/bin/sh
set -e

echo "Setting up container..."

# Detect current UID/GID
CURRENT_UID=$(id -u)
CURRENT_GID=$(id -g)

# Default app user values
APP_USER="wgo"
DEFAULT_UID=1000
DEFAULT_GID=1000

# Determine what UID/GID to use
if [ "$CURRENT_UID" -eq 0 ]; then
    # Running as root → create a non-root user
    RUN_UID=$DEFAULT_UID
    RUN_GID=$DEFAULT_GID
else
    # Running as a custom UID → use that
    RUN_UID=$CURRENT_UID
    RUN_GID=$CURRENT_GID
fi

echo "Setting permissions for UID:$RUN_UID GID:$RUN_GID..."

# Create group if needed
if ! getent group "$APP_USER" >/dev/null 2>&1; then
    groupadd -g "$RUN_GID" "$APP_USER"
fi

# Create user if needed and UID != 0
if ! id -u "$APP_USER" >/dev/null 2>&1 && [ "$RUN_UID" -ne 0 ]; then
    useradd -u "$RUN_UID" -g "$RUN_GID" -m "$APP_USER"
fi

# Fix ownership of web root and data folder
chown -R "$RUN_UID:$RUN_GID" /var/www/html
chmod -R 755 /var/www/html/data

# Update Apache to run as this user if not root
if [ "$RUN_UID" -ne 0 ]; then
    sed -i "s/APACHE_RUN_USER=.*/APACHE_RUN_USER=$APP_USER/" /etc/apache2/envvars
    sed -i "s/APACHE_RUN_GROUP=.*/APACHE_RUN_GROUP=$APP_USER/" /etc/apache2/envvars
fi

echo "Permissions set. Starting Apache..."

# Execute main command
exec "$@"