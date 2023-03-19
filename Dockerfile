FROM php:8.0.0-apache

# Instalar extensiones necesarias para el proyecto
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copiar el código del proyecto en la imagen
COPY . /var/www/html/