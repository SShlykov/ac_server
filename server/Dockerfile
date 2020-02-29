FROM php:7.2-fpm

# Configure the gd library

#RUN docker-php-ext-configure \
#  gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/

RUN apt-get install && apt-get update -y 

# RUN curl -sL https://raw.githubusercontent.com/creationix/nvm/v0.33.11/install.sh -o install_nvm.sh \
#     bash install_nvm.sh \
#     sh \
#     bash \
#     nvm install 8.16.2
# Install required PHP extensions
RUN docker-php-ext-install \
#  gd \
#  intl \
  mbstring \
#  mcrypt \
  pdo_mysql
#  xsl \
#  zip \
#  soap

COPY ./php.ini /usr/local/etc/php/

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN mkdir /server/

WORKDIR /server/
