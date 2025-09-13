FROM php:8.1-cli

# Install PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Set working directory
WORKDIR /app

# Copy project files
COPY . .

# Start PHP built-in server
CMD ["php", "-S", "0.0.0.0:8080", "-t", "."]