# Discount Service



## Objectives

Calculate discounts for orders.

This service receives an order in JSON format, sent in the request body.
Then it returns the same information received adding some more information:
* `total-before-discount` - The original value of `total` attribute received within the order. This is returned for every item in the order and for the order itself.
* `discounts-descriptions` - Descriptions of all the discounts there were applied. It is returned empty if no discount was applied.

More details can be found here: https://github.com/teamleadercrm/coding-test/blob/master/1-discounts.md



## Development

This service was built using the [Yii Framework 2](https://www.yiiframework.com/) and it uses [Composer](https://getcomposer.org/) to manage its dependencies. Yii is a MVC framework.
[Codeception](https://codeception.com/) were used to create some tests.

The following resources/documentation where used during the development:
* [Using Yii as a Micro-framework](https://www.yiiframework.com/doc/guide/2.0/en/tutorial-yii-as-micro-framework)
* [Restful Web Services](https://www.yiiframework.com/doc/guide/2.0/en/rest-quick-start)
* [Yii2 Testing](https://www.yiiframework.com/doc/guide/2.0/en/test-overview)
* [Codeception Yii2 Module](https://codeception.com/docs/modules/Yii2)

### Folder Structure
```
root
├── config      <-- application configuration files
├── controllers <-- application controllers
├── data        <-- sample data for custormers, products and orders
├── discounts   <-- discounts logic
├── helpers     <-- helper/utility classes
├── models      <-- application models
├── services    <-- components to simulate other services
├── tests       <-- tests
├── vendor      <-- 3rd party packages managed by composer
├── web         <-- application entry scripts
```

### How to add a new discount

Create a new class inside the `discounts` folder. This class must implement IDiscount interface
and a public method called `apply`. This method is were you must define the discount application
logic and make adjustments to the order model.

This method receives the following arguments:

* &$order - an [Order](models/Order.php) model with all the order information.
* $customer - a [Customer](models/Customer.php) model with information about the customer placing the order.
* $products - an array of [Product](models/Product.php) models representing the products in the order.

**Warning: All discounts directly modify the Order object.**

Then edit the Order model and add the new discount to the `activeDiscounts` property
in the order you want it to be applied.


## Instructions to run this service

After cloning this repository, install the dependencies by executing inside the project root folder:

    composer install

From the root folder run this command to start a simple webserver:

    ./vendor/bin/yii serve --docroot=./web

Make note of the address the server is listening. Usually it is *http://localhost:8080*

Start sending requests to the service using a REST client like [Insomnia](https://insomnia.rest/).



## Available endpoints

* GET /discounts/ping - Check if this service is up and running.
* POST /discounts - Receive an order in JSON format in the body of the request and returns the order with the discounts applied. Includes discounts description.



## Authentication

For simplicity authentication is not needed. It can be easily done by following the
[Authentication Documentation](https://www.yiiframework.com/doc/guide/2.0/en/rest-authentication).



## Testing

There are some Codeception tests available.

### Acceptance tests

These tests really comunicates with an up and running server. Make sure you had run `./vendor/bin/yii serve` command as explanined above before executing the acceptance tests.

    ./vendor/bin/codecept run acceptance
