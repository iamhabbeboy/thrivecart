FROM php:8.4-cli-alpine

# Install system dependencies and bcmath
RUN apk add --no-cache \
        git \
        unzip \
        zip \
        libzip-dev \
        oniguruma-dev \
    && apk add --no-cache --virtual .build-deps \
        gcc g++ make autoconf \
    && docker-php-ext-install bcmath \
    && apk del .build-deps

# Set working directory
WORKDIR /app

# Install Composer globally
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist

# Default command
CMD ["php", "-v"]