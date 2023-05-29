FROM php:8.2.1-apache


# Instal·lar extensions PHP necessàries i ferramentes addicionals
RUN docker-php-ext-install mysqli
RUN a2enmod rewrite


# Copiar fitxers de l'aplicació
COPY . /var/www/html


# Establir directori de treball
WORKDIR /var/www/html


# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer


# Instal·lar dependències de PHP
RUN composer install


# Instal·lar dependències de Node.js i compilar assets
RUN apt-get update && apt-get install -y \
   curl \
   libpng-dev \
   npm \
   && rm -rf /var/lib/apt/lists/*
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install -y nodejs
RUN npm install
RUN npm run dev


# Configurar comanda d’inici del contenidor
CMD php artisan serve --host=0.0.0.0 --port=8000


# Crear grup "sail"
RUN groupadd --force -g 1001 sail
