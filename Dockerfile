# Use official PHP CLI image
FROM php:8.4-cli

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    php-bcmath \
    && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /app

# Install Composer globally
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install

# Default command
CMD ["php", "-v"]