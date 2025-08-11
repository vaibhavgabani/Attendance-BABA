FROM node:20 AS frontend-builder

# Set working directory for frontend
WORKDIR /app

# Copy frontend files
COPY Frontend /app

# Install and build frontend
RUN npm install --legacy-peer-deps
RUN npm run build || (echo "Frontend build failed" && exit 1)

FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    libzip-dev \
    supervisor

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# Enable Apache modules
RUN a2enmod rewrite proxy proxy_http headers

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy backend files
COPY Backend /var/www/html

# Copy .env.docker to .env if it exists, otherwise use .env.example
RUN if [ -f /var/www/html/.env.docker ]; then \
        cp /var/www/html/.env.docker /var/www/html/.env; \
    elif [ -f /var/www/html/.env.example ]; then \
        cp /var/www/html/.env.example /var/www/html/.env; \
    else \
        echo "APP_NAME=Laravel" > /var/www/html/.env; \
        echo "APP_ENV=production" >> /var/www/html/.env; \
        echo "APP_DEBUG=false" >> /var/www/html/.env; \
        echo "APP_URL=http://localhost" >> /var/www/html/.env; \
        echo "DB_CONNECTION=mysql" >> /var/www/html/.env; \
    fi

# Set permissions
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Install backend dependencies
RUN composer install --no-interaction --optimize-autoloader

# Generate application key
RUN php artisan key:generate --force

# Clear cache and run migrations
RUN php artisan config:clear
RUN php artisan cache:clear

# Configure Apache for Laravel
RUN sed -i 's/DocumentRoot \/var\/www\/html/DocumentRoot \/var\/www\/html\/public/g' /etc/apache2/sites-available/000-default.conf
RUN sed -i 's/Listen 80/Listen 8000/g' /etc/apache2/ports.conf
RUN sed -i 's/<VirtualHost \*:80>/<VirtualHost *:8000>/g' /etc/apache2/sites-available/000-default.conf

# Copy the built frontend from the frontend-builder stage
COPY --from=frontend-builder /app/dist /var/www/frontend/dist

# Install Node.js for serving the frontend
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash -
RUN apt-get install -y nodejs

# Create a simple server file
RUN mkdir -p /var/www/frontend/server
RUN echo 'const http = require("http");\n\
const fs = require("fs");\n\
const path = require("path");\n\
const PORT = 3000;\n\
\n\
const MIME_TYPES = {\n\
  ".html": "text/html",\n\
  ".js": "text/javascript",\n\
  ".css": "text/css",\n\
  ".json": "application/json",\n\
  ".png": "image/png",\n\
  ".jpg": "image/jpg",\n\
  ".svg": "image/svg+xml",\n\
  ".ico": "image/x-icon"\n\
};\n\
\n\
http.createServer((request, response) => {\n\
  console.log(`${request.method} ${request.url}`);\n\
  \n\
  let filePath = path.join(__dirname, "../dist", request.url);\n\
  if (filePath.endsWith("/")) {\n\
    filePath = path.join(filePath, "index.html");\n\
  }\n\
  \n\
  if (request.url !== "/favicon.ico" && !path.extname(filePath)) {\n\
    filePath = path.join(__dirname, "../dist", "index.html");\n\
  }\n\
  \n\
  const extname = String(path.extname(filePath)).toLowerCase();\n\
  const contentType = MIME_TYPES[extname] || "application/octet-stream";\n\
  \n\
  fs.readFile(filePath, (error, content) => {\n\
    if (error) {\n\
      if (error.code === "ENOENT") {\n\
        fs.readFile(path.join(__dirname, "../dist", "index.html"), (error, content) => {\n\
          response.writeHead(200, { "Content-Type": "text/html" });\n\
          response.end(content, "utf-8");\n\
        });\n\
      } else {\n\
        response.writeHead(500);\n\
        response.end(`Server Error: ${error.code}`);\n\
      }\n\
    } else {\n\
      response.writeHead(200, { "Content-Type": contentType });\n\
      response.end(content, "utf-8");\n\
    }\n\
  });\n\
}).listen(PORT, "0.0.0.0");\n\
\n\
console.log(`Frontend server running at http://0.0.0.0:${PORT}/`);' > /var/www/frontend/server/index.js

# No need to install Express, using Node.js built-in modules
RUN cd /var/www/frontend && npm init -y

# Setup Supervisor to run both services
RUN mkdir -p /etc/supervisor/conf.d

# Create supervisor configuration file
RUN printf '[supervisord]\n\
nodaemon=true\n\
logfile=/var/log/supervisor/supervisord.log\n\
pidfile=/var/run/supervisord.pid\n\
\n\
[program:apache]\n\
command=apache2-foreground\n\
stdout_logfile=/dev/stdout\n\
stdout_logfile_maxbytes=0\n\
stderr_logfile=/dev/stderr\n\
stderr_logfile_maxbytes=0\n\
\n\
[program:frontend]\n\
command=node /var/www/frontend/server/index.js\n\
directory=/var/www/frontend\n\
stdout_logfile=/dev/stdout\n\
stdout_logfile_maxbytes=0\n\
stderr_logfile=/dev/stderr\n\
stderr_logfile_maxbytes=0' > /etc/supervisor/conf.d/supervisord.conf

# Expose ports
EXPOSE 8000 3000

# Start Supervisor to manage both servers
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
