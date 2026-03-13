FROM alpine:3.20

RUN apk add --no-cache \
    ca-certificates \
    nginx \
    php82 \
    php82-fpm \
    php82-pdo \
    php82-sqlite3 \
    php82-opcache \
    sqlite \
    tzdata

RUN adduser -D -g '' app \
    && mkdir -p /var/www /run/php /run/nginx \
    && chown -R app:app /var/www /run/php /run/nginx

WORKDIR /var/www
COPY . /var/www

COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/php-fpm-www.conf /etc/php82/php-fpm.d/www.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

RUN chmod +x /usr/local/bin/entrypoint.sh \
    && chown -R app:app /var/www

EXPOSE 80

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
