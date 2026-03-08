# Base image with PHP & Apache
FROM php:8.2-apache

WORKDIR /var/www/html

# Enable mod_rewrite for PHP
RUN a2enmod rewrite

# Install PHP extensions and runtime user switching utility
RUN apt-get update && apt-get install -y \
        libsqlite3-dev \
        unzip \
        git \
        gosu \
    && docker-php-ext-install pdo pdo_sqlite \
    && docker-php-ext-enable pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

# Run Apache on an unprivileged port so the container can run as non-root if desired
RUN sed -ri 's/^Listen 80$/Listen 8080/' /etc/apache2/ports.conf \
    && sed -ri 's/<VirtualHost \*:80>/<VirtualHost *:8080>/' /etc/apache2/sites-available/000-default.conf

# Copy app code
COPY public/ /var/www/html/
COPY src/ /var/www/html/src/

# Create writable folders
RUN mkdir -p /var/www/html/data /var/www/html/uploads

# Copy entrypoint
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

EXPOSE 8080

# Start app
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["apache2-foreground"]