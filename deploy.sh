#!/bin/bash

git fetch --all
git reset --hard origin/master
git pull origin master

rm -rf apis/wu-learn-api/
git clone https://github.com/alexanderhofstaetter/wu-learn-api.git apis/wu-learn-api/
chmod +x apis/wu-learn-api/*.py

composer install
php artisan migrate --force

# Update Version
if [ -e "storage/app/version" ]; then
  rm storage/app/version
fi
touch storage/app/version
date +"%Y.%m.%d" > storage/app/version

