
.PHONY: build up down composer composer-install composer-autoload

default:
	docker-compose up

network:
	docker network create -d bridge maithai

build:
	docker-compose build

up:
	docker-compose up

down:
	docker-compose down

composer:
	docker-compose exec php-fpm bash -c "composer $(cmd)"

composer-update:
	docker-compose exec php-fpm bash -c "composer update"

composer-install:
	docker-compose exec php-fpm bash -c "composer install"

composer-autoload:
	docker-compose exec php-fpm bash -c "composer dump-autoload"

laravel-install:
	docker-compose exec php-fpm bash -c "composer create-project --prefer-dist laravel/laravel . '6.*'"

artisan:
	docker-compose exec php-fpm bash -c "php artisan $(cmd)"
	sudo chmod -R 775 $(CURDIR)/www/$(path)
	#sudo chown -R ${USER}:${USER} $(CURDIR)/www/$(path)

permission:
	sudo chmod -R ${num} $(CURDIR)/www/$(path)
	sudo chown -R ${USER}:${USER} $(CURDIR)/www/$(path)

permissions:
	sudo chmod -R 775 $(CURDIR)/www/
# 	sudo chown -R www-data:www-data $(CURDIR)/www/
	sudo chown -R ${USER}:${USER} $(CURDIR)/www/
	sudo chmod -R 777 $(CURDIR)/www/storage
	sudo chmod -R 777 $(CURDIR)/www/vendor
	sudo chmod -R 777 $(CURDIR)/www/public

scheduler:
	docker-compose exe php-fpm bash -c "artisan schedule:run >> /dev/null 2>&1"

phpunit:
	docker-compose exec php-fpm bash -c "./vendor/bin/phpunit ${option}"
