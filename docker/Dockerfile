# Base image with PHP & Apache
FROM php:8.2-apache

WORKDIR /var/www/html

# Enable mod_rewrite for PHP
RUN a2enmod rewrite

# Install PHP extensions
RUN apt-get update && apt-get install -y \
        libsqlite3-dev \
        unzip \
        git \
    && docker-php-ext-install pdo pdo_sqlite \
    && docker-php-ext-enable pdo_sqlite \
    && rm -rf /var/lib/apt/lists/*

# Copy app code
COPY public/ /var/www/html/
COPY src/ /var/www/html/src/

# Create data folder
RUN mkdir -p /var/www/html/data

# Create uploads folder
RUN mkdir -p /var/www/html/uploads

# Copy entrypoint
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Expose custom port
EXPOSE 13420

# Start app
ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["apache2-foreground"]