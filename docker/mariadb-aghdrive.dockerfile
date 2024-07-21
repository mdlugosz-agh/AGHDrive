# Local development
FROM mariadb:10.1.26


ADD initMariaDB.sql /docker-entrypoint-initdb.d/init.sql
RUN chmod -R 775 /docker-entrypoint-initdb.d

# Zmieniamy strefe czasowo kontnera
RUN ln -sf /usr/share/zoneinfo/Europe/Warsaw /etc/localtime