<?php
/**
 * Configuration file for testing the application.
 * It's based on the configuration file main.php and
 * any configuration made here overwrites the configurations
 * defined on main.php
 */
return yii\helpers\ArrayHelper::merge(
    require(__DIR__ . '/main.php'),
    [
        'id' => 'teamleader-discount-api-test',

        // Overwrite database configuration for the tests,
        // like pointing to a test database.
        /*'components' => [
            'db' => [
                'dsn' => 'mysql:host=localhost;dbname=yii_app_test',
            ]
        ]*/
    ]
);
