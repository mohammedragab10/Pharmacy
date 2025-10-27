# ==========================
# Stage 1 - Build Dependencies
# ==========================
FROM composer:2 AS build

WORKDIR /app

# انسخ ملفات المشروع
COPY . /app

# نزّل dependences بتاعة PHP بدون dev packages
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# ==========================
# Stage 2 - Runtime Image
# ==========================
FROM php:8.2-fpm

# تثبيت الأدوات المهمة وامتدادات PHP
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libonig-dev libxml2-dev libzip-dev \
    nodejs npm \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

WORKDIR /var/www/html

# انسخ الملفات من مرحلة build
COPY --from=build /app /var/www/html

# إنشاء نسخة من env.example لو .env مش موجود (لتجنب مشاكل key:generate)
RUN if [ ! -f .env ]; then cp .env.example .env; fi

# توليد APP_KEY فقط، بدون الاعتماد على DB
RUN php artisan key:generate --force || true

# افتح البورت اللي Railway بيستخدمه (PORT بيجي من المتغير البيئي)
EXPOSE 8000

# أمر تشغيل Laravel
CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8000}
