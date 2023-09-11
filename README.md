# Test Task

## Installation
- copy env files
    - `cp .env.sample .env`
    - `cp services/api/.env.example services/api/.env`
- run `docker compose up -d`
- run `docker compose exec php php artisan key:generate`
- run `docker compose exec php php artisan migrate --seed`
