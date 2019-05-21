FROM php:7.2-apache

RUN apt-get update && apt-get install -y \
                           libfreetype6-dev \
                           libjpeg62-turbo-dev \
                           libmcrypt-dev \
                           libpng-dev \
                           zlib1g-dev \
                           libicu-dev \
                           g++ \
 && apt-get install -y vim git zlib1g-dev mysql-client libzip-dev \
 && docker-php-ext-configure intl \
 && docker-php-ext-install -j$(nproc) iconv intl pdo zip mysqli pdo_mysql mbstring \
 && pecl install xdebug \
 && docker-php-ext-enable xdebug \
 && echo 'xdebug.remote_enable=on' >> /usr/local/etc/php/conf.d/xdebug.ini \
 && echo 'xdebug.remote_host=host.docker.internal' >> /usr/local/etc/php/conf.d/xdebug.ini \
 && echo 'xdebug.remote_port=9000' >>  /usr/local/etc/php/conf.d/xdebug.ini \
 && a2enmod rewrite \
 && sed -i 's!/var/www/html!/var/www/public!g' /etc/apache2/sites-available/000-default.conf \
 && mv /var/www/html /var/www/public \
 && curl -sS https://getcomposer.org/installer \
  | php -- --install-dir=/usr/local/bin --filename=composer \
 && echo "AllowEncodedSlashes On" >> /etc/apache2/apache2.conf

WORKDIR /var/www/public

COPY index.php /var/www/public
COPY .editorconfig /var/www/public
COPY .gitattributes /var/www/public
COPY .gitignore /var/www/public
COPY .htaccess /var/www/public
COPY composer.json /var/www/public
COPY composer.lock /var/www/public
COPY phpunit.xml.dist /var/www/public
COPY bin/ /var/www/public/bin/
COPY config/ /var/www/public/config/
COPY logs/ /var/www/public/logs/
COPY mysql/ /var/www/public/mysql/
COPY plugins/ /var/www/public/plugins/
COPY src/ /var/www/public/src/
COPY tmp/ /var/www/public/tmp/
COPY vendor/ /var/www/public/vendor/
COPY webroot/ /var/www/public/webroot/

RUN chmod -R 777 /var/www/public/tmp/
RUN chmod -R 777 /var/www/public/logs/
