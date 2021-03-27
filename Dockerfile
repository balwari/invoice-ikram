FROM php:7.3-fpm

# Install PHP extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

