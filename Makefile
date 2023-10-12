build:
	docker-compose build --no-cache --force-rm
up:
	docker-compose up -d
stop:
	docker-compose stop
queuework:
	docker-compose run --rm artisan queue:work --tries=3
install:
	docker-compose run --rm artisan migrate
	docker-compose run --rm artisan db:seed
	docker-compose run --rm artisan storage:link
	#run queue