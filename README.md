# MinIO S3 Demo using Laravel 10

A small app developed for S3 API demonstration purpose.

## Local Testing

### Setup Process

1. Git Clone and CD to project root directory.

2. Run below Commands:

**Copy Envs and Update as needed**

```
cp .env.example .env
cp docker/.env.example docker/.env
cp docker/docker-compose.override.example.yml docker/docker-compose.override.yml
cp docker/.envs/minio.example.env docker/.envs/minio.env
```

**Build and Generate Keys, Migrations**

```
docker compose build
docker compose run --rm app php artisan key:generate
docker compose run --rm app php artisan migrate -f
```

### Running the App

1. Run `docker compose up -d`
1. Visit `http://localhost:8080`


## Deploying in Kubernetes

1. Create `secret.yaml` from `secret.example.yaml` and update as needed. Put base64 encoded values on those keys.
    1. You can get `APP_KEY` value by runing `docker compose run --rm app php artisan key:generate`. Then just base64 encode it.
1. Apply below yaml files using kubectl.

```
kubectl apply -f kubernetes/configmap.yaml
kubectl apply -f kubernetes/secret.yaml
kubectl apply -f kubernetes/deployment.yaml
kubectl apply -f kubernetes/service.yaml
```
