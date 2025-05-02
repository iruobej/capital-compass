FROM php:8.4-apache

# Enabling Apache mod_rewrite for routing
RUN a2enmod rewrite

# Installing system packages required for PostgreSQL
RUN apt-get update && apt-get install -y libpq-dev

# Installing PDO with PostgreSQL support
RUN docker-php-ext-install pdo pdo_pgsql

# Copying project files
COPY . /var/www/html/

WORKDIR /var/www/html/

