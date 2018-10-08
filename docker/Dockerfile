FROM nginx:alpine

RUN mkdir /app

RUN mkdir /run/php

RUN mkdir /usr/local/nvm

ADD php.ini /etc/php7/conf.d/custom.ini

ADD php-fpm.conf /etc/php7/php-fpm.d/www.conf

ADD nginx.conf /etc/nginx/conf.d/default.conf

RUN touch /var/log/hold

RUN touch /root/.profile

RUN apk add php7-common php7-fpm php7-gd php7-imap php7-mbstring php7-mcrypt php7-pdo_mysql php7-pdo php7-opcache php7-xml php7-curl php7-pdo_sqlite php7-zip unzip php7-pdo php7-mysqli php7-json php7-curl php7-xml php7-simplexml php7-tokenizer php7-phar php7-fileinfo php7-dom php7-xmlwriter php7-openssl

RUN apk add bash git curl unzip nodejs nodejs-npm openssh-client

RUN apk add tzdata && cp /usr/share/zoneinfo/America/Los_Angeles /etc/localtime && echo "America/Los_Angeles" > /etc/timezone && apk del tzdata

RUN npm install -g bower gulp

CMD nginx & php-fpm7 -F -R && tail -f /var/log/hold
