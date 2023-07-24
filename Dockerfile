FROM php:8.2-apache

# Install extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

ENV APACHE_DOCUMENT_ROOT=/var/www/html/api
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Copy application source including .htaccess
COPY . .

# Set permissions for .htaccess
# Set permissions for the working directory and its contents
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html

# Set permissions for .htaccess
RUN chown www-data:www-data /var/www/html/api/.htaccess
RUN chmod 644 /var/www/html/api/.htaccess