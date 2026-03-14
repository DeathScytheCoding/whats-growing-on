# LinuxServer nginx image includes s6 and PUID/PGID mapping
FROM lscr.io/linuxserver/nginx:latest

# Install sqlite3 for init-time schema setup/migrations (Alpine)
RUN apk add --no-cache sqlite

# Custom site content and init scripts
COPY root/ /
RUN chmod +x /custom-cont-init.d/10-init /custom-cont-init.d/20-db-init

EXPOSE 80
