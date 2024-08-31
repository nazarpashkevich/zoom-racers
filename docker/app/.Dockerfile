# Use the base image with PHP 8.3 and Nginx
FROM serversideup/php:8.3-fpm-nginx

# Set the working directory
WORKDIR /var/www/html

# Copy project files to the working directory
COPY . /var/www/html

USER root

# Install Node.js and npm, then build the frontend assets
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs && \
    npm install && npm run build

# Set correct permissions for the application files
RUN chown -R www-data:www-data /var/www/html

USER www-data

# Remove the vendor directory and clear Composer cache
RUN rm -rf vendor && composer clear-cache

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev --ignore-platform-reqs

# Set correct permissions for the storage and cache directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
