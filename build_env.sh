#!/bin/bash

cp api/.env.example .env

sed -i -e "s/APP_ENV=local/APP_ENV=${APP_ENV}/g" .env
sed -i -e "s/APP_DEBUG=true/APP_DEBUG=false/g" .env
sed -i -e "s/{DB_HOST_IP}/${DB_HOST_IP}/g" .env
sed -i -e "s/{DB_DATABASE}/${DB_DATABASE}/g" .env
sed -i -e "s/{DB_USERNAME}/${DB_USERNAME}/g" .env
sed -i -e "s/{DB_PASSWORD}/${DB_PASSWORD}/g" .env
sed -i -e "s/{DB_HOST_IP}/${DB_HOST_IP}/g" .env
sed -i -e "s/{APP_URL}/https:\/\/${FQDN}/g" .env

sed -i -e "s/{G_CLIENT_ID}/${G_CLIENT_ID}/g" .env
sed -i -e "s/{G_CLIENT_SECRET}/${G_CLIENT_SECRET}/g" .env
sed -i -e "s/{G_REDIRECT_URI}/https:\/\/${FQDN}\/login\/google\/callback/g" .env

mv .env ./api/.env
