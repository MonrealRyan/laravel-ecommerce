## Pre Requisite

- Composer 2
- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)

#### Note:
if you have installed MYSQL and Apache you need to disabled it first before running this project due to the port issue.

## Tech-stack

 - Laravel 10 + [Laravel Sail](https://laravel.com/docs/10.x/sail)
 - Blade
 - Vite
 - Javascript
 - Html
 - Mysql
 - phpunit (for testing)

## How to run

 - clone the project and proceed to the project folder
 - run `composer install` installation of pre-requisite packages
 - run `./vendor/bin/sail -f docker-compose-local.yml up` or `sail -f docker-compose-local.yml up` more info about [Laravel Sail](https://laravel.com/docs/10.x/sail)
    - Note for `sail up` command this will only work if you may wist to add a shell alias for this [check here](https://laravel.com/docs/10.x/sail#configuring-a-shell-alias)

## Test
 - run `./vendor/bin/sail test` or `sail test`

## Scope

This application is a simple e-commerce where in it can disaplay 3 categories Couches, Chair, and Dinning under it is the products that the user
can view the details and checkout. After successful checkout user will receive email about the order details.
