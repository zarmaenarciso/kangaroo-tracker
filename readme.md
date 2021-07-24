# kangaroo-tracker

Please run the following commands to set up the environment

# install dependencies
composer install

# start up docker
docker-compose up -d

# access docker shell
docker-compose exec web sh

# create tables and seed data
php artisan migrate -seed