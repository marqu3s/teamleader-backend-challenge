<?php
/**
 * Configuration file for the application.
 */

use yii\rest\UrlRule;
use yii\web\JsonParser;

return [
    'id' => 'teamleader-discount-api',

    // The basePath of the application directory.
    'basePath' => __DIR__ . '/../',

    // This is where the application will find all controllers.
    'controllerNamespace' => 'api\controllers',

    // The default controller and action name.
    'defaultRoute' => 'discounts/index',

    // Set an alias to enable auto-loading of classes from the 'api' namespace.
    'aliases' => [
        '@api' => __DIR__ . '/../',
    ],

    'components' => [
        // Data base configuration. This app doesn't require a database.
        /*'db' => [
            'dsn' => 'mysql:host=localhost;dbname=yii_app',
        ],*/

        // Configures the URL rules of the application/service.
        // With the following configuration 2 URL's will be available in this service:
        // - GET /discounts/ping
        // - POST /discounts
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => UrlRule::class,
                    'controller' => 'discount',
                    'patterns' => [
                        'GET ping' => 'ping',
                        'POST' => 'index',
                    ]
                ],

                /*
                * FYI: Considering a controller named "User",
                * the default rules available with the UrlRule are:
                * 'PUT,PATCH users/<id>' => 'user/update',
                * 'DELETE users/<id>' => 'user/delete',
                * 'GET,HEAD users/<id>' => 'user/view',
                * 'POST users' => 'user/create',
                * 'GET,HEAD users' => 'user/index',
                * 'users/<id>' => 'user/options',
                * 'users' => 'user/options',
                */
            ],
        ],

        // Enable the application to parse JSON requests.
        'request' => [
            'parsers' => [
                'application/json' => JsonParser::class,
            ],
        ],
    ],
];
