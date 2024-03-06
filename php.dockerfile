FROM php:7.3.7-apache
#MAINTAINER Caio Barroncas

######
# You can configure php extensions using docker-php-ext-configure
# You can install php extensions using docker-php-ext-install
######

# define timezone
RUN echo "America/Sao_Paulo" > /etc/timezone
RUN dpkg-reconfigure -f noninteractive tzdata
RUN /bin/echo -e "LANG=\"en_US.UTF-8\"" > /etc/default/local

# install dependencies
RUN apt-get update
RUN apt-get install -y --no-install-recommends \
    build-essential \
    libfreetype6-dev \
    libjpeg-dev \
    libjpeg62-turbo-dev \
    libmcrypt-dev \
    libpng-dev \
    libwebp-dev \
    curl \
    #libcurl4 \
    libcurl4-openssl-dev \
    zlib1g-dev \
    libicu-dev \
    libmemcached-dev \
    memcached \
    default-mysql-client \
    libmagickwand-dev \
    libxml2-dev \
    unzip \
    libzip-dev \
    zip \
    libpq-dev \
    nano;

# ldap example
# RUN docker-php-ext-install ldap
# RUN docker-php-ext-configure ldap --with-libdir=lib

# memcached
RUN pecl install memcached-3.1.5
RUN docker-php-ext-enable memcached

# opcache
RUN pecl install opcache
RUN apache.ini /usr/local/etc/php/conf.d/opcache.ini

# mcrypt
# RUN pecl install mcrypt
# RUN docker-php-ext-enable mcrypt

# teste
RUN a2enmod rewrite
ADD . /var/www/html

# RUN docker-php-ext-install -j$(nproc) opcache
RUN docker-php-ext-install -j$(nproc) pdo_mysql
RUN docker-php-ext-install -j$(nproc) mysqli
RUN docker-php-ext-install -j$(nproc) pdo
RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install -j$(nproc) intl
RUN docker-php-ext-install -j$(nproc) zip
# RUN docker-php-ext-install -j$(nproc) ldap

# postgresql
# RUN docker-php-ext-install -j$(nproc) pdo_pgsql

# configure, install and enable all php packages
RUN docker-php-ext-configure gd --enable-gd --with-webp --with-freetype-dir --with-jpeg-dir
# RUN docker-php-ext-configure gd --enable-gd

RUN docker-php-ext-configure pdo_mysql --with-pdo-mysql=mysqlnd
RUN docker-php-ext-configure mysqli --with-mysqli=mysqlnd
RUN docker-php-ext-configure intl
RUN docker-php-ext-configure zip

# install xdebug
# RUN pecl install xdebug
# RUN docker-php-ext-enable xdebug

# RUN echo "xdebug.remote_enable=1" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
# RUN echo "xdebug.remote_autostart=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
# RUN echo "xdebug.default_enable=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
# RUN echo "xdebug.remote_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
# RUN echo "xdebug.remote_port=9000" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
# RUN echo "xdebug.remote_connect_back=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
# RUN echo "xdebug.profiler_enable=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
# RUN echo "xdebug.remote_log=\"/tmp/xdebug.log\"" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# # configure opcache
# RUN echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache-recommended.ini
# RUN echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/opcache-recommended.ini
# RUN echo "opcache.max_accelerated_files=4000" >> /usr/local/etc/php/conf.d/opcache-recommended.ini
# RUN echo "opcache.revalidate_freq=2" >> /usr/local/etc/php/conf.d/opcache-recommended.ini
# RUN echo "opcache.fast_shutdown=1" >> /usr/local/etc/php/conf.d/opcache-recommended.ini

WORKDIR /var/www/html/
COPY . /var/www/html/
COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html

COPY . .

# install imagick
RUN pecl install imagick
RUN docker-php-ext-enable imagick

# Permissions
# RUN chown -R root:www-data /var/www/html
# RUN chmod u+rwx,g+rx,o+rx /var/www/html
# RUN find /var/www/html -type d -exec chmod u+rwx,g+rx,o+rx {} +
# RUN find /var/www/html -type f -exec chmod u+rw,g+rw,o+r {} +

# Instalando composer
# RUN php -r "copy('http://getcomposer.org/installer', 'composer-setup.php');"
# RUN php composer-setup.php
# RUN php -r "unlink('composer-setup.php');"
# RUN mv composer.phar /usr/local/bin/composer

# Clear package lists
# RUN apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite
RUN service apache2 restart

EXPOSE 80