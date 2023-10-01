FROM php:8.0-apache
COPY ports.conf /etc/apache2/ports.conf
COPY example-apache.conf /etc/apache2/sites-available/example-apache.conf
RUN docker-php-ext-install mysqli
RUN a2ensite example-apache.conf