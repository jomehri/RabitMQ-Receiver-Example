## Questioner

## What's included:

- Production Readiness (Dockerized)
- No Eloquent, Doctrine used (pure mysql)
- Unit/Feature tests
- No Laravel rabbitMQ packages used (like vyuldashev 's package), just pure php-amqplib used
- Strategy & Repository design patterns

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
- docker-compose exec php-web php artisan migrate
- open up a few consumer workers by this command in multiple terminals: docker-compose exec php-web php artisan rabbitmq:consume
- docker-compose exec php-web php artisan rabbitmq:produce (to produce 1000 messages)
