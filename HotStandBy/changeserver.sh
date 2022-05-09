#!/bin/bash

sudo system ctl start DBServer.service

sshpass -p "PASSWORD" ssh -t frontend@frontendip "cd /var/www/html/ sudo rm -r testRabbitMQ.ini;"
cd filepath/to/hotstandby
sshpass -p "PASSWORD" scp testRabbitMQ.ini frontend@frontendip "cd filepath to documents; sudo cp testRabbitMQ.ini /var/www/html"
sshpass -p "PASSWORD" ssh -t frontend@frontendip "sudo systemctl restart apache2.service"
#EOF
