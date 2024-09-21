# Use the base image with PHP 8.3 and Nginx
FROM serversideup/php:8.3-fpm-nginx

# Set the working directory
WORKDIR /var/www/html

# Copy project files to the working directory
COPY . /var/www/html

USER root

RUN apt update && apt-get install -y nodejs gconf-service libasound2 libatk1.0-0 libc6 libcairo2 libcups2 libdbus-1-3 \
    libexpat1 libfontconfig1 libgbm1 libgcc1 libgconf-2-4 libgdk-pixbuf2.0-0 libglib2.0-0 libgtk-3-0 libnspr4 \
    libpango-1.0-0 libpangocairo-1.0-0 libstdc++6 libx11-6 libx11-xcb1 libxcb1 libxcomposite1 libxcursor1 libxdamage1 \
    libxext6 libxfixes3 libxi6 libxrandr2 libxrender1 libxss1 libxtst6 ca-certificates fonts-liberation \
    libappindicator1 libnss3 lsb-release xdg-utils wget libgbm-dev libxshmfence-dev

# Install Node.js and npm, then build the frontend assets
RUN curl -sL https://deb.nodesource.com/setup_20.x | bash - && \
    apt-get install -y nodejs && \
    npm install

RUN npm run build

# Set correct permissions for the application files
RUN chown -R www-data:www-data /var/www/html

USER www-data

RUN npx puppeteer browsers install chrome

# Remove the vendor directory and clear Composer cache
RUN rm -rf vendor && composer clear-cache

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-dev --ignore-platform-reqs

# Set correct permissions for the storage and cache directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
