FROM php:8.2-apache

# Install mysqli and dependencies
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy project files
COPY . /var/www/html/

EXPOSE 80
