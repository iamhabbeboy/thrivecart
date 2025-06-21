up:
	docker-compose up --build

bash:
	docker-compose run --rm app sh

app:
	docker-compose run --rm app php index.php

test:
	docker-compose run --rm app ./vendor/bin/phpunit

stan:
	docker-compose run --rm app ./vendor/bin/phpstan analyse src --level=max
