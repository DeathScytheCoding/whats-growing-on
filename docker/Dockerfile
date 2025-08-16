# Use a base image with PHP and Apache pre-installed
FROM php:8.3-apache

# Install SQLite and the PDO SQLite extension for PHP
RUN apt-get update && \
    apt-get install -y sqlite3 libsqlite3-dev && \
    docker-php-ext-install pdo_sqlite

# Enable the Apache rewrite module
RUN a2enmod rewrite

# Update the default Apache configuration to allow .htaccess overrides
# This allows rewrite rules defined in .htaccess files to be effective.
RUN echo '<Directory /var/www/html>' >> /etc/apache2/sites-available/000-default.conf && \
    echo '  AllowOverride All' >> /etc/apache2/sites-available/000-default.conf && \
    echo '</Directory>' >> /etc/apache2/sites-available/000-default.conf

# Remove the default index.html file that comes with Apache
#RUN rm /var/www/html/index.html

# Copy your application files into the document root
COPY ./webfiles/ /var/www/html/

RUN mkdir /var/www/data
RUN chmod 777 /var/www/data

# Expose port 80 for the web server
EXPOSE 80

# The base image already handles the Apache foreground process,
# so a separate CMD instruction is often not needed.
# If you encounter issues, you might need to add:
# CMD ["apache2ctl", "-D", "FOREGROUND"]
