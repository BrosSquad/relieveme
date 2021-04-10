FROM brossquad/php-dev:8.0-1.0.5

WORKDIR /var/www/html

RUN apt install git -y

COPY . .

EXPOSE 9000
EXPOSE 9003

CMD [ "php-fpm" ]
