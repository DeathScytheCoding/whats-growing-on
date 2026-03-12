# Base image includes PHP and Apache
FROM php:8.3-apache

# Install SQLite and PHP's PDO SQLite extension
RUN apt-get update && \
    apt-get install -y sqlite3 libsqlite3-dev && \
    docker-php-ext-install pdo_sqlite && \
    rm -rf /var/lib/apt/lists/*

# Enable Apache rewrite module
RUN a2enmod rewrite

# Allow .htaccess overrides so rewrite rules are honored
RUN echo '<Directory /var/www/html>' >> /etc/apache2/sites-available/000-default.conf && \
    echo '  AllowOverride All' >> /etc/apache2/sites-available/000-default.conf && \
    echo '</Directory>' >> /etc/apache2/sites-available/000-default.conf

# Optional: remove the default Apache index.html
#RUN rm /var/www/html/index.html

# Application files
COPY public/ /var/www/html/
COPY src/ /var/www/html/backend

# Create a non-root user/group for Apache (uid/gid 1000)
RUN groupadd -g 1000 wgo && \
    useradd -u 1000 -g 1000 -s /usr/sbin/nologin -d /home/wgo -m wgo

# Create app data directories and set ownership
RUN mkdir -p /app/data /app/uploads && \
    chmod 755 /app/data /app/uploads && \
    chown -R wgo:wgo /var/www/html /app/data /app/uploads

# Ensure Apache runtime paths are writable by the non-root user
RUN chown -R wgo:wgo /var/run/apache2 /var/lock/apache2 /var/log/apache2

# Run Apache as the non-root user
ENV APACHE_RUN_USER=wgo \
    APACHE_RUN_GROUP=wgo

# Listen on an unprivileged port to avoid extra capabilities
RUN sed -i 's/^Listen 80$/Listen 8080/' /etc/apache2/ports.conf && \
    sed -i 's/<VirtualHost \*:80>/<VirtualHost *:8080>/' /etc/apache2/sites-available/000-default.conf

# Expose Apache on an unpriveleged port
EXPOSE 8080

# Change to non-root user
USER wgo

# The base image already runs Apache in the foreground.
# If you encounter startup issues, you can add:
# CMD ["apache2ctl", "-D", "FOREGROUND"]
