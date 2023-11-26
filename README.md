# Setup

## Change from current directory into the project directory

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

## Composer install, run migrations and seed db

```$xslt
make composer-install
make migrate
make db:seed
```

## Run Tests

```$xslt
make test
```

## Address

```$xslt
http://localhost:8000/timeline
```

## Stop Docker Containers

```$xslt
make stop
```

## Access container's sh

```$xslt
make sh
```
