# Setup

## Change current directory into the project directory

```ssh
cd recruitment-platform
```

## Create .env file

```$xslt
cp .env.example .env
```

## Start Docker containers

```$xslt
make start
```

## Composer install & run migrations

```$xslt
make composer-install
make migrate:install
make migrate
```

## Run DatabaseSeeder

```$xslt
make db:seed
```

## Run Tests

```$xslt
make test
```

## Stop Docker Containers

```$xslt
make stop
```

## How to access container's sh

```$xslt
make sh
```
