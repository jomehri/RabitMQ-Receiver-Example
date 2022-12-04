## Questioner

## What's included:

- Production Readiness (Dockerized)
- No Eloquent, Doctrine used (pure mysql)
- No Laravel rabbitMQ packages used (like vyuldashev 's package), just pure php-amqplib used
- Strategy & Repository design patterns
- Using Laravel service container concept, binding of services & repositories
- Unit/Feature tests
- White Box testing for services without triggering real message delivery (mocking)
- Black Box feature tests to test the start/end point of services

## Installation:

- [install docker](https://docs.docker.com/get-docker/) based on your system environment
- cd project folder
- cd docker
- docker-compose up
- cd ../src
- cp .env.example .env
- cp .env.testing.example .env.testing
- composer install --ignore-platform-reqs
- sudo chmod 777 storage/ -R
- cd ../docker
- sudo docker-compose exec qst-php-web php artisan migrate:fresh
- sudo docker-compose exec qst-php-web php artisan migrate:fresh --env=testing
- open up a few consumer workers by this command in multiple terminals: sudo docker-compose exec qst-php-web php artisan
  rabbitmq:consume
- sudo docker-compose exec qst-php-web php artisan rabbitmq:produce (to produce 1000 messages)
- sudo docker-compose exec qst-php-web php artisan test
