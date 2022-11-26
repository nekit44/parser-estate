init: docker-down-clear docker-pull docker-build docker-up composer-update
up: docker-up
down: docker-down
restart: down up web-app
test: test-run


docker-up:
	docker-compose up -d

docker-down:
	docker-compose down --remove-orphans

docker-down-clear:
	docker-compose down -v --remove-orphans

docker-pull:
	docker-compose pull

docker-build:
	docker-compose build

composer-update:
	docker-compose exec php-cli composer update

test-run:
	docker-compose exec php-cli php vendor/bin/phpunit test


