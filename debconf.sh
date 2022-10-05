#!/bin/bash
debconf-set-selections <<< 'mysql-server mysql-server/root_password password hackathon'
debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password hackathon'

debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2"
debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true"  
debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-user string root"  
debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password hackathon"  
debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password hackathon"  
debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password hackathon"