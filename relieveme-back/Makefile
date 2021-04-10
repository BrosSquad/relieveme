install:
	sh exec composer install
	cp .env.example .env
	sh exec php artisan key:generate

migrate:
	sh exec php artisan migrate:fresh --seed
