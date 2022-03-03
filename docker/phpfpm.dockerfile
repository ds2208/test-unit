FROM cubesdoo/php-fpm:latest

RUN apt-get update && \
    apt-get -y install libwebp-dev libpng-dev libjpeg-dev && \
    docker-php-ext-configure gd --with-webp-dir --with-jpeg-dir --with-freetype --with-png-dir && \
    apt-get -y install wget && \
    docker-php-ext-install gd && \
    wget -O /home/localuser/wkhtml.deb https://github.com/wkhtmltopdf/wkhtmltopdf/releases/download/0.12.5/wkhtmltox_0.12.5-1.stretch_amd64.deb && \
    apt-get install -y xfonts-base xfonts-75dpi && \
    dpkg -i /home/localuser/wkhtml.deb 
