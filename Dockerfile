# LinuxServer nginx image includes s6 and PUID/PGID mapping
FROM lscr.io/linuxserver/nginx:latest

# Custom site content and init scripts
COPY root/ /
RUN chmod +x /custom-cont-init.d/10-init

EXPOSE 80