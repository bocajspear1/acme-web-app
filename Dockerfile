FROM ubuntu:16.04


RUN bash -c "debconf-set-selections <<< 'mysql-server mysql-server/root_password password hackathon'"
RUN bash -c "debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password hackathon'"

RUN apt-get update
RUN apt-get install -y apache2 libapache2-mod-php php-mysql mysql-server

COPY html/ /var/www/html
COPY database.sql /tmp/database.sql
RUN rm /var/www/html/index.html

RUN echo "[client]\nuser=root\npassword = hackathon" > /root/.my.cnf; chmod 600 /root/.my.cnf; cat /root/.my.cnf
RUN /etc/init.d/mysql start && sleep 10; echo 'CREATE DATABASE `hackathon`;' | mysql; mysql hackathon < /tmp/database.sql

RUN sed -i 's/display_errors = Off/display_errors = On/' /etc/php/7.0/apache2/php.ini

EXPOSE 80

CMD /usr/sbin/apachectl start; /usr/sbin/mysqld;