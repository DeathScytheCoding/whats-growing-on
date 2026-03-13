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
    tzdata \
    su-exec \
    shadow

RUN adduser -D -g '' wgo \
    && mkdir -p /var/www /run/php /run/nginx \
    && chown -R wgo:wgo /var/www /run/php /run/nginx

RUN addgroup wgo tty

WORKDIR /var/www
COPY . /var/www

COPY docker/nginx.conf /etc/nginx/nginx.conf
COPY docker/php-fpm-www.conf /etc/php82/php-fpm.d/www.conf
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh

# Redirect logs to docker
RUN ln -sf /dev/stdout /var/log/nginx/access.log \
	&& ln -sf /dev/stderr /var/log/nginx/error.log

RUN chmod +x /usr/local/bin/entrypoint.sh \
    && chown -R wgo:wgo /var/www

EXPOSE 8080

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
