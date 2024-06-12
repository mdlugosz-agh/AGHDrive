FROM phpmyadmin:latest

# Zmieniamy strefe czasowo kontnera
RUN ln -sf /usr/share/zoneinfo/Europe/Warsaw /etc/localtime