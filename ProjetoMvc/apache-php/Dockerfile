#Usando php 7.4 e o servidor apache-php
FROM php:7.4-apache

#Instalando esses pacotes na imagem na hora da construcao
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Instala dependências necessárias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    libicu-dev \
    g++ \
    autoconf \
    make \
    && pecl install xdebug-3.1.6 \
    && docker-php-ext-enable xdebug \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copia configuração personalizada do php.ini
COPY php.ini /usr/local/etc/php/conf.d/


# Copia arquivos
COPY php.ini /usr/local/etc/php/conf.d/


#Habilita o mod_rewrite do apache-php, para url amigaveis
RUN a2enmod rewrite

# Configurar o apache-php para permitir .htaccess
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf
