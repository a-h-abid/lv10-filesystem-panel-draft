# MinIO S3 Demo using Laravel 10

A small app developed for S3 API demonstration purpose.

## Setup Process

1. Git Clone and CD to project root directory.

2. Run below Commands:

```
cp .env.example .env
cp docker/.env.example docker/.env
cp docker/docker-compose.override.example.yml docker/docker-compose.override.yml
cp docker/.envs/minio.example.env docker/.envs/minio.env
docker compose build
docker compose run --rm app php artisan key:generate
docker compose run --rm app php artisan migrate -f
```

## Running the App

1. Run `docker compose up -d`
1. Visit `http://localhost:8080`
