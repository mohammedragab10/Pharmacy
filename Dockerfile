# 1️⃣ استخدم صورة PHP الرسمية
FROM php:8.2-fpm

# 2️⃣ تثبيت الأدوات الأساسية وامتدادات PHP المطلوبة
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    nodejs \
    npm \
    && docker-php-ext-configure zip \
    && docker-php-ext-install pdo pdo_mysql zip gd

# 3️⃣ تعيين مجلد العمل
WORKDIR /var/www/html

# 4️⃣ نسخ ملفات المشروع
COPY . .

# 5️⃣ تثبيت Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 6️⃣ تثبيت اعتمادات PHP
RUN composer install --no-interaction --optimize-autoloader --no-dev

# 7️⃣ تثبيت npm packages وبناء الواجهة (لو بتستخدم Vite أو Mix)
RUN npm install && npm run build

# 8️⃣ توليد مفتاح Laravel
RUN php artisan key:generate

# 9️⃣ إعداد الصلاحيات
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# 🔟 فتح المنفذ
EXPOSE 8000

# 1️⃣1️⃣ تشغيل السيرفر
CMD php artisan serve --host=0.0.0.0 --port=8000
