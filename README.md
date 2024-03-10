# PIZZA API

Stack tecnologico: PHP8.3(Symfony7: API Platform), MySQL, Nginx

## Entorno Dockerizado

**Debes tener instalado Docker y Docker Compose en tu equipo.**

**Los comandos del Makefile están preparados para ser ejecutados dentro del contenedor de Docker**

**El comando: make load-fixtures-data, solo sirve en el entorno de DEV**

- [ ] Instalar la network de los contenedores en caso de no tenerla instalada antes:

```shell
docker network create app-network
```

- [ ] Levantar los contenedores:

```shell
docker-compose -p pizza up -d
```

- [ ] Acceder al contenedor de PHP:

```shell
docker exec -it php-fpm bash 
```

- [ ] Después de entrar al contenedor de php-fpm, para inicializar el proyecto debes ejecutar:

```shell
make init-project
```

## Acceso al sistema

Después de desplegar el proyecto correctamente, debe acceder al siguiente enlace

[`documentación de las API's`](http://localhost:8080/api)

- [ ] Para carga pizzas de pruebas, debes ejecutar:

```shell
make load-fixtures-data
```

- [ ] Para actualizar la base de datos:

```shell
make update-database-schema
```