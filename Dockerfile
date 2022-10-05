FROM ubuntu:18.04

COPY debconf.sh /debconf.sh 

RUN bash -c 'chmod +x /debconf.sh && /debconf.sh'

RUN apt-get -qq update \
&& DEBIAN_FRONTEND="noninteractive" apt-get install -y apache2 libapache2-mod-php php-mysql mariadb-server

RUN /etc/init.d/mysql start && sleep 10 && DEBIAN_FRONTEND="noninteractive" apt-get install -y phpmyadmin iputils-ping wget && /etc/init.d/mysql stop && sleep 10

COPY database.sql /tmp/database.sql
RUN rm /var/www/html/index.html

# A patch for an error in phpmyadmin
# https://stackoverflow.com/a/50536059
RUN sed -i "s/|\s*\((count(\$analyzed_sql_results\['select_expr'\]\)/| (\1)/g" /usr/share/phpmyadmin/libraries/sql.lib.php
RUN echo "[client]\nuser=root\npassword = hackathon" > /root/.my.cnf; chmod 600 /root/.my.cnf; cat /root/.my.cnf
RUN /etc/init.d/mysql start && sleep 10; echo 'CREATE DATABASE `hackathon`;' | mysql; mysql hackathon < /tmp/database.sql
RUN /etc/init.d/mysql start && sleep 10 && echo "CREATE USER 'admin'@'localhost' IDENTIFIED BY 'hackathon'; GRANT ALL PRIVILEGES ON *.* TO 'admin'@'localhost' WITH GRANT OPTION; FLUSH PRIVILEGES;" | mysql -u root && /etc/init.d/mysql stop && sleep 10

RUN sed -i 's/display_errors = Off/display_errors = On/' /etc/php/7.2/apache2/php.ini

COPY app/ /var/www/html

EXPOSE 80

CMD /usr/sbin/apachectl start; /usr/bin/mysqld_safe