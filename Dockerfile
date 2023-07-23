FROM php:8.0-apache

# Install extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy application source
COPY . .