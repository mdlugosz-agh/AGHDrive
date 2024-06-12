# FROM php:8.3.4-apache
FROM php:7.1-apache

RUN apt-get update
RUN apt-get install -y htop nano default-mysql-client

# Instalacje mysqli za
# https://stackoverflow.com/questions/46879196/mysqli-not-found-dockerized-php
# jeśli nie działa to trzeba jeszcze wywołać:
# docker-php-ext-enable mysqli
# mozna tez wywołać z linii komend contenrea dockerowego
# ustawieni strefy czasowej w php.ini
# https://stackoverflow.com/questions/32224547/setting-the-timezone-for-php-in-the-php-ini-file
RUN docker-php-ext-install mysqli
# ZipArchiwe
# https://stackoverflow.com/questions/48700453/docker-image-build-with-php-zip-extension-shows-bundled-libzip-is-deprecated-w
RUN apt-get install -y zlib1g-dev zip libzip-dev

RUN docker-php-ext-install zip 
# GD
# https://stackoverflow.com/questions/39657058/installing-gd-in-docker
RUN apt-get install -y libpng-dev
RUN docker-php-ext-install gd

# RUN apt install -y cron 
# https://nickjanetakis.com/blog/docker-tip-7-the-difference-between-run-and-cmd
# CMD service cron start

# SSL 
#https://forums.docker.com/t/setup-local-domain-and-ssl-for-php-apache-container/116015/2