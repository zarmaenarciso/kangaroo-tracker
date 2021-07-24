Please run the following commands to set up the environment

# install dependencies
$ composer install

# start up docker
$ docker-compose up -d

# access docker shell
$ docker-compose exec web sh

# create tables and seed data
You might encounter an error because db might not be finished initializing. Please wait for a moment before running the command
$ php artisan migrate -seed