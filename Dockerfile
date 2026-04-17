FROM php:8.4-fpm

RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxml2-dev \
    sqlite3 \
    libsqlite3-dev \
    zip \
    unzip \
    git

# GD を JPEG/PNG/WebP 対応でビルド
RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    --with-webp \
    && docker-php-ext-install gd

# その他の拡張
RUN docker-php-ext-install pdo_sqlite bcmath


COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY . .

RUN chmod -R 777 storage bootstrap/cache

# シンボリックリンクを作成
RUN rm -rf /var/www/public/storage
RUN ln -s /var/www/storage/app/public /var/www/public/storage