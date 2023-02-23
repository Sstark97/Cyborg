FROM php:8.1-apache
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
COPY . /var/www/html
ENV DB_HOST=mariadb
ENV DB_USER=aitor97
ENV DB_PASS=12345
ENV DB_NAME=GameShop
ENV ADMIN_DNI=123456789A
ENV ADMIN_NAME=admin
ENV ADMIN_SURNAME=admin
ENV ADMIN_EMAIL=admin@admin.com
ENV ADMIN_PHONE=111111111
ENV ADMIN_AGE=99
ENV ADMIN_PASS=AdminDaw1234
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN apt-get update && apt-get install -y apt-transport-https
RUN apt-get install zip unzip
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN composer install
RUN composer du
CMD [ "php", "./config/install.php" ]