# Ceiboo DDDS
Ceiboo DDDS es un skeleton DDD para Symfony

### Installation ###
* `git clone git@github.com:Ceiboo/ceiboo-ddd.git`
* `cd ceiboo-ddd`
* `docker-compose build ceiboo`
* `docker-compose up -d`
* `docker-compose exec ceiboo composer update`

### Setting your computer ###
In your file /etc/hosts add
* `127.0.0.1 api.ceiboo.jla`
* `127.0.0.1 auth.ceiboo.jla`

### Test ###
- Test in console:
* `docker-compose exec ceiboo php command status --app=api/mid10`
* `docker-compose exec ceiboo php command status --app=backend/auth`

- Test in postman:
* `http://api.ceiboo.jla/status`
* `http://auth.ceiboo.jla/status`

- Acceptance test:
* `docker-compose exec ceiboo ./vendor/bin/behat -p api_mid10`
* `docker-compose exec ceiboo ./vendor/bin/behat -p auth_user`

- Unit Test:
* `docker-compose exec ceiboo ./vendor/bin/phpunit -c apps/auth/user/phpunit.xml`

### Otros comandos ###
Para bajar los dockers
* `docker-compose down`
