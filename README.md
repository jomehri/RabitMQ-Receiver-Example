## Questioner

## What's included:

- Production Readiness (Dockerized)
- SOLID, DRY, OOP, KISS
- Unit/Feature tests

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
- docker-compose exec qst-php-web php /var/www/html/artisan migrate
- visit http://localhost:9085