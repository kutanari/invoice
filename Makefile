setup:
	docker-compose up -d --build

stop:
	docker-compose down

start:
	docker-compose up -d

migrate:
	docker-compose exec app bash -c " \
		cd application \
		&& ../vendor/bin/phalcon migration run \
	"

reset-migration:
	docker-compose exec app bash -c " \
		cd application \
		&& > .phalcon/migration-version \
	"
