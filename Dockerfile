FROM php:7.2-apache

RUN apt-get update \
 && apt-get install -y vim git zlib1g-dev mysql-client libzip-dev \
 && docker-php-ext-install zip mysqli pdo_mysql \
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
COPY README.md /var/www/public
COPY bin/ /var/www/public/bin/
COPY config/ /var/www/public/config/
COPY logs/ /var/www/public/logs/
COPY plugins/ /var/www/public/plugins/
COPY src/ /var/www/public/src/
COPY tmp/ /var/www/public/tmp/
COPY vendor/ /var/www/public/vendor/
COPY webroot/ /var/www/public/webroot/
