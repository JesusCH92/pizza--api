#! /bin/bash

##	init-project:			instalamos lo que necesita el proyecto
init-project:
	- composer install
	- php bin/console doctrine:database:drop --force
	- php bin/console doctrine:database:create
	- php bin/console doctrine:schema:create
	- php bin/console doctrine:schema:validate
	- php bin/phpunit


##	update-database-schema:	ejecutamos las migraciones
update-database-schema:
	- php bin/console doctrine:migrations:migrate --no-interaction

##	load-fixtures-data:		cargamos pizzas para hacer pruebas
load-fixtures-data:
	- php bin/console doctrine:fixture:load --no-interaction

##	test:		            ejecutamos test
test:
	- php bin/phpunit