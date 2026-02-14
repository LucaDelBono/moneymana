FROM php:8.2-apache

# Install estensioni PHP necessarie
RUN docker-php-ext-install mysqli pdo pdo_mysql opcache

# Abilita mod_rewrite
RUN a2enmod rewrite

# Copia configurazione Apache
COPY virtualhost.conf /etc/apache2/sites-available/000-default.conf

# Imposta permessi corretti
RUN chown -R www-data:www-data /var/www/html

# Abilita opcache (performance)
RUN { \
    echo "opcache.enable=1"; \
    echo "opcache.memory_consumption=128"; \
    echo "opcache.interned_strings_buffer=8"; \
    echo "opcache.max_accelerated_files=4000"; \
    echo "opcache.revalidate_freq=2"; \
    echo "opcache.fast_shutdown=1"; \
} > /usr/local/etc/php/conf.d/opcache.ini
