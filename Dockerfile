# Use the official PHP Apache image
FROM php:8.2-apache

# Copy all files to the container
COPY . /var/www/html/

# Expose port 80
EXPOSE 80