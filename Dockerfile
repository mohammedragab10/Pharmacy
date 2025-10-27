# ==========================
#  Stage 1 - Build Dependencies
# ==========================
FROM composer:2 AS build

WORKDIR /app

# انسخ ملفات المشروع
COPY . /app

# نزّل dependences بتاعة PHP
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader


# ==========================
#  Stage 2 - Runtime Image
# ==========================
FROM php:8.2-fpm

# نضيف بعض الأدوات المهمة
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

WORKDIR /var/www/html

# انسخ الملفات من مرحلة build
COPY --from=build /app /var/www/html

# اعمل copy لملف env.example لو .env مش موجود
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# Laravel setup
RUN php artisan key:generate --force \
    && php artisan config:clear \
    && php artisan cache:clear \
    && php artisan route:clear \
    && php artisan view:clear

# افتح البورت اللي Railway بيستخدمه (يسحب PORT تلقائي من البيئة)
EXPOSE 8000

# Start Laravel
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
