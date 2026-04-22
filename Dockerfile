FROM php:8.2-apache

#Instalar extension mysql para conectarse a MySQL
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli

#Reinciciar Apache para aplicar cambios
RUN service apache2 restart 