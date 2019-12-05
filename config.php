<?php
/**
 * Configuration file for the application.
 */

return [
    'id' => 'teamleader-discount-api',

    // The basePath of the application directory.
    'basePath' => __DIR__,

    // This is where the application will find all controllers.
    'controllerNamespace' => 'api\controllers',

    // The default controller and action name.
    'defaultRoute' => 'discounts/index',

    // Set an alias to enable autoloading of classes from the 'api' namespace.
    'aliases' => [
        '@api' => __DIR__,
    ],

    'components' => [
        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => true,
            'showScriptName' => false,
            'rules' => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'discount',
                    'except' => ['create', 'update', 'view', 'delete'],
                ],

                /*
                * The rules available with the UrlRule are:
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

        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ]
    ],
];
