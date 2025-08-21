FROM php:8.1-apache

# Copy all files into Apache server root
COPY . /var/www/html/

# Render requires your service to listen on port 10000
ENV PORT=10000

# Reconfigure Apache to listen on Render's port
RUN sed -i "s/80/\${PORT}/g" /etc/apache2/ports.conf \
    && sed -i "s/80/\${PORT}/g" /etc/apache2/sites-enabled/000-default.conf

# Expose the port Render expects
EXPOSE 10000

# Start Apache in foreground
CMD ["apache2-foreground"]
