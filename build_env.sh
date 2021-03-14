#!/bin/bash

cp api/.env.example ./api/.env

sed -i -e "s/APP_DEBUG=true/APP_DEBUG=false/g" ./api/.env
sed -i -e "s/DB_HOST=127.0.0.1/DB_HOST=192.168.12.129/g" ./api/.env
sed -i -e "s/DB_DATABASE=macrame/DB_DATABASE=${DB_USERNAME}/g" ./api/.env
sed -i -e "s/DB_PASSWORD=12345/DB_DATABASE=${DB_PASSWORD}/g" ./api/.env
sed -i -e "s/http:\/\/localhost/http:\/\/${FQDN}/g" ./api/.env
