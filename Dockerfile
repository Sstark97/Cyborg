FROM php:8.1-apache
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY . /var/www/html
RUN apt-get update && apt-get install zip unzip
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN composer install
RUN composer du
WORKDIR /var/www/html
RUN php ./config/install.php