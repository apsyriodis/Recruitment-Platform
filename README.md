# Prerequisites
Before running this application, ensure you have docker-compose installed.
To check if you have Docker Compose installed, run the following command in your terminal:
```bash
docker-compose --version
```

# Setup

## Change from current directory into the project directory

```bash
cd recruitment-platform
```

## Create .env file

```bash
cp .env.example .env
```

## Start Docker containers

```bash
make start
```

## Composer install, run migrations and seed db

```bash
make composer-install
make migrate
make db:seed
```

## To view the project's home page, click the link below

[Recruitment App - Homepage](http://localhost:8000/timeline)

## Run Tests

```bash
make test
```

## Stop Docker Containers

```bash
make stop
```

## Access container's sh

```bash
make sh
```
