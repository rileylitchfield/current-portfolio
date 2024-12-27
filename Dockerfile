# Use an official PHP image with Apache
FROM php:8.1-apache

# Install Composer
RUN apt-get update && apt-get install -y curl unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copy website files to the web root
COPY . /var/www/html

# Install PHP dependencies (PHPMailer)
WORKDIR /var/www/html
RUN composer install

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache when the container runs
CMD ["apache2-foreground"]
