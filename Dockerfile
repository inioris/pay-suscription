FROM php:7.1.3-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install zip

# Enable Apache rewrite module
RUN a2enmod rewrite

# Set the document root
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy the project files to the working directory
COPY . /var/www/html

# Install project dependencies
RUN composer install --no-interaction

# Set the correct permissions
RUN chown -R www-data:www-data /var/www/html/storage

# Expose port 80 and start Apache server
EXPOSE 80
CMD ["apache2-foreground"]
