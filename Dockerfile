# Usamos una imagen oficial de PHP
FROM php:8.2-fpm

# Instalar las dependencias necesarias para Laravel
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev zip git && \
    docker-php-ext-configure gd --with-freetype --with-jpeg && \
    docker-php-ext-install gd pdo pdo_mysql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establecer el directorio de trabajo dentro del contenedor
WORKDIR /var/www

# Copiar todos los archivos del proyecto Laravel al contenedor
COPY . .

# Instalar las dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Configuración de permisos (necesario para Laravel)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Exponer el puerto que usará la aplicación (por defecto Laravel usa 8000)
EXPOSE 8000

# Comando para ejecutar Laravel (puedes cambiar este comando si usas un servidor web como Nginx o Apache)
CMD ["php-fpm"]