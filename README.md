## Questioner

## What's included:

- Production Readiness (Dockerized)
- No Eloquent, Doctrine used (pure mysql)
- Unit/Feature tests
- No Laravel rabbitMQ packages used (like vyuldashev 's package), just pure php-amqplib used

## Installation:

- [install docker](https://docs.docker.com/get-docker/) based on your system environment
- cd project folder
- cd docker
- docker-compose up
- cd ../src
- composer install
- cp .env.example .env
- cp .env.testing.example .env.testing
- sudo chmod 777 storage/ -R
- cd ../docker
- docker-compose exec alijomehri-php-web php artisan migrate
- docker-compose exec alijomehri-php-web php artisan rabbitmq:produce (to produce messages)
