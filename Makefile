run:
	docker compose build
	docker compose up -d
	docker compose exec -t php chmod -R 755 /var/www/storage
	docker compose exec -t php composer install
	docker compose exec -t php php artisan migrate --seed

shell:
	docker compose exec -it php sh