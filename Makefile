sh:
	docker-compose exec app sh

start:
	docker-compose up -d

stop:
	docker-compose down

restart:
	docker-compose restart

migrate\:install:
	docker-compose exec app php artisan migrate:install

migrate:
	docker-compose exec app php artisan migrate

migrate\:rollback:
	docker-compose exec app php artisan migrate:rollback

test:
	docker-compose exec app vendor/bin/phpunit tests

composer-install:
	docker-compose exec app composer install

db\:seed:
	docker-compose exec app php artisan db:seed