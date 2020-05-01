all: build
	(git pull)

build:
	(composer install)

run:
	(php -S localhost:8000 api/public/index.php)

db_reset:
	composer dumpautoload
	php artisan migrate:refresh --seed

doc:
	(cd docs && make run)
