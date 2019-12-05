# Discount Service



## Objectives

Calculate discounts for orders.

Details can be found here: https://github.com/teamleadercrm/coding-test/blob/master/1-discounts.md



## Development

This service was built using the [Yii Framework 2](https://www.yiiframework.com/) and it uses [Composer](https://getcomposer.org/) to manage its dependencies.

The following resources/documentation where used during the development:
* [Using Yii as a Micro-framework](https://www.yiiframework.com/doc/guide/2.0/en/tutorial-yii-as-micro-framework)
* [Restful Web Services](https://www.yiiframework.com/doc/guide/2.0/en/rest-quick-start)



## Instructions to run this service

After cloning this repository, install the dependencies by executing inside the project root folder:

    composer install

From the root folder run this command to start a simple webserver:

    ./vendor/bin/yii serve --docroot=./web

Make note of the address the server is listening. Usually it is *http://localhost:8080*

Start sending requests to the service using a REST client like [Insomnia](https://insomnia.rest/).



## Available endpoints

* GET /discounts - Receive an order in JSON format in the body of the request and returns the order with the discounts applied. Includes discounts description.
