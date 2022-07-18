# Ceiboo DDD
Ceiboo DDD es un skeleton base en el que implementaremos Domain Driven Design

### Installation ###
* `git clone git@github.com:Ceiboo/ceiboo-ddd.git`
* `cd ceiboo-ddd`
* `docker-compose build ceiboo`
* `docker-compose up -d`
* `docker-compose exec ceiboo composer update`

### Ingresar a la app ###
En tu archivo /etc/hosts incluir las siguientes lineas
* `127.0.0.1 api.ceiboo.jla`
* `127.0.0.1 auth.ceiboo.jla`

* `127.0.0.1 mysql.ceiboo.jla`


### Testear que funciona ###
- Test de instalación en terminal:
* `docker-compose exec ceiboo php command status --app=api/mid10`
* `docker-compose exec ceiboo php command status --app=backend/auth`

- Test de instalación en navegador:
* `http://api.ceiboo.jla/status`
* `http://auth.ceiboo.jla/status`

- Test de aceptación en terminal:
* `docker-compose exec ceiboo ./vendor/bin/behat -p api_mid10`
* `docker-compose exec ceiboo ./vendor/bin/behat -p auth_user`

- Test unitarios y test de integracion
* `docker-compose exec ceiboo ./vendor/bin/phpunit -c apps/auth/user/phpunit.xml`

### Acceso a base de datos ###
* `http://mysql.ceiboo.jla`

### Otros comandos ###
Para bajar los dockers
* `docker-compose down`
