# Dockerfile para PHP 8.3 FPM com Node.js

# Use a imagem base PHP 8.3 FPM
FROM php:8.3-fpm

# Argumentos definidos no docker-compose.yml
ARG user
ARG uid

# Atualiza e instala as dependências do sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libonig-dev \
    libpq-dev \
    libcurl4-openssl-dev \
    unzip \
    vim \
    && apt-get clean

# Instala as extensões do PHP necessárias
RUN docker-php-ext-install \
    curl \
    pgsql \
    pdo_pgsql \
    pdo_mysql \
    mbstring \
    exif \
    pcntl \
    bcmath

# Instala o Xdebug
RUN pecl install xdebug-3.3.1 \
    && docker-php-ext-enable xdebug

# Instala Node.js e NPM
RUN curl -fsSL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

# Instala o gerenciador de pacotes do Laravel (Composer)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Cria usuário do sistema para executar comandos do Composer e Artisan
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Define o diretório de trabalho
WORKDIR /var/www

# Define o usuário não-root para execução de comandos dentro do contêiner
USER $user
