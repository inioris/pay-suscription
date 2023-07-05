FROM php:7.3-apache

# Instalar dependencias y extensiones necesarias
RUN apt-get update && \
    apt-get install -y \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-install zip pdo_mysql

# Configurar Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf && \
    a2enmod rewrite

# Copiar archivos del proyecto
COPY . .

# Configurar directorios y permisos
RUN mkdir -p storage/framework/{sessions,views,cache} && \
    chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R 775 storage bootstrap/cache && \
    mkdir -p storage/logs && \
    chmod -R 777 storage/logs

# Copiar archivo de configuración de host de Apache
COPY apache.conf /etc/apache2/sites-available/000-default.conf

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar dependencias de Composer
RUN composer install --no-scripts --no-autoloader

# Generar la clave de la aplicación
RUN php artisan key:generate

# Ejecutar el comando de carga de clases de Composer
RUN composer dump-autoload --optimize

# Configurar el puerto
ENV PORT=80
EXPOSE 80

# Iniciar el servidor Apache
CMD ["apache2-foreground"]
