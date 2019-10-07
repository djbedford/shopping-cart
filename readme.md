## Installation

- Clone repository
- Run `composer install`
- Copy .env.example to .env, no need to change anything
- In root of project run `docker-compose up --build` I use docker as my development environment so docker will need 
to be installed but should work using homestead too
- Execute `docker container exec -it shopping-cart_app_1 bash` you are now in the docker container, run the below commands
- Run `php artisan migrate` I have used an sqlite database just to store the products
- Run `php artisan db:seed`
- You should now be able to go to localhost:8080/products
- To run the tests first run `docker container exec -it shopping-cart_app_1 bash` again if you exited previously, then
- Run `vendor/bin/phpunit`
