FROM php:8.2-apache

# Enabling Apache mod_rewrite for routing
RUN a2enmod rewrite

# Installing MySQL PDO driver
RUN docker-php-ext-install pdo pdo_mysql

# Copying project files
COPY . /var/www/html/

WORKDIR /var/www/html/

