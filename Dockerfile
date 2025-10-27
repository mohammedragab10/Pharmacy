# استخدم PHP 8.2 مع Apache
FROM php:8.2-apache

# فعّل ملحقات PHP اللي Laravel بيحتاجها
RUN docker-php-ext-install pdo pdo_mysql

# انسخ ملفات المشروع داخل السيرفر
COPY . /var/www/html

# ثبّت Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# ادخل على مجلد المشروع وثبّت الـ dependencies
WORKDIR /var/www/html
RUN composer install && php artisan key:generate

# فعّل mod_rewrite في Apache علشان Laravel routing يشتغل
RUN a2enmod rewrite
RUN service apache2 restart

# ابدأ السيرفر
CMD ["apache2-foreground"]
