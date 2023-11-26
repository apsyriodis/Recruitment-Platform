
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

## To view the project's timelines, click the link below

[Timelines](http://localhost:8000/timeline)

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
