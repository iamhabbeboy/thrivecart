up:
	docker-compose up --build

bash:
	docker-compose run --rm app bash

test:
	docker-compose run --rm app ./vendor/bin/phpunit

stan:
	docker-compose run --rm app ./vendor/bin/phpstan analyse src --level=max
