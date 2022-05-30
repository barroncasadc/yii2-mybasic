<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';
$baseUrl = str_replace('/web', '', (new \yii\web\Request)->getBaseUrl());

$config = [
    'id' => '#^&BLucp&q0SC^2KRAqEPSHqtnWsuqELZ^uv$^zhxmegmQ@Lo%',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'DJ0O3qqMDa@zz7z@KU*^Ay4Go*3BW73%lNta4Nv#7rQJXk5g1M',
            'baseUrl' => $baseUrl,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'session' => [
            'name'         => '#^&BLucp&q0SC^2KRAqEPSHqtnWsuqELZ^uv$^zhxmegmQ@Lo%',
            'class'        => 'yii\web\Session',
            'cookieParams' => ['httponly' => true, 'lifetime' => 604800],
            'timeout'      => 604800,
            'useCookies'   => true,
        ],
        
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '' => 'site/index',
                '<controller:\w+>/<action:\w+>/' => '<controller>/<action>',
            ],
        ],
        
    ],
    'params' => $params,
];

if (getenv('ENVIRONMENT') == 'DEV' || ENVIRONMENT == "DEV") {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['*'],
    ];
}

return $config;
