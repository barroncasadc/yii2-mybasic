<?php
use \yii\web\Request;
$params = require __DIR__ . '/params.php';

// // $db = require __DIR__ . '/test_db.php' :
$db = require __DIR__ . '/db.php';

$baseUrl = str_replace('/web', '', (new Request)->getBaseUrl());

$config = [
    'id' => getenv('ID_CONFIG'),
    'basePath' => dirname(__DIR__),

    'language' => 'pt-BR',
    'timezone' => 'America/Manaus',
    'charset'=>'utf-8',

    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => getenv('COOKIE_VALIDATION_KEY'),
            'baseUrl' => $baseUrl,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        // CUSTOM PARAMS ----------------------------------
        'ConvertToBase64' => [
            'class' => 'app\components\ConvertToBase64'
        ],
        'RequestPath' => [
            'class' => 'app\components\RequestPath'
        ],      
        'Utils'=>[
            'class'=> 'app\components\Utils'
         ],
        // CUSTOM PARAMS ----------------------------------

        'session' => [
            'name'         => 'sAX#3TPWCQO8J&eaUTF368gMiiDs6gnn^sj^BapbqVD*uVP8CF',
            'class'        => 'yii\web\Session',
            'cookieParams' => ['httponly' => true, 'lifetime' => 604800],
            'timeout'      => 604800,
            'useCookies'   => true,
        ],
        
        // --------------
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'authTimeout' => 3600 * 24, // auth expire 
        ],
        // 'session' => [
        //     'class' => 'yii\web\DbSession',
        //     'sessionTable' => 'yii_session',
        //     'name' => 'mySession',
        //     // 'db' => 'mydb',  // the application component ID of the DB connection. Defaults to 'db'.
        //     // 'sessionTable' => 'my_session', // session table name. Defaults to 'session'.
        //     'timeout' => 30 * 24 * 3600,
        //     // 'auto_start ' => 1,
        //     'cookieParams' => ['httponly' => true, 'lifetime' => 3600 * 24],
        //     'writeCallback' => function ($session) {
        //         // return true;

        //         return [
        //             // 'user_id' => Yii::$app->user->id,
        //             // 'last_write' => 'xxxx',
        //         ];
        //     },
        // ],
        // --------------
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
                // ['class' => 'app\components\RandomIdUrlRule'],
                // ['class' => 'yii\rest\UrlRule', 'controller' => 'api'],
            ],
        ],
        
    ],

    // force login ------------------------------------------------
    // 'as beforeRequest' => [ //if guest user access site so, redirect to login page.
    //     'class' => 'yii\filters\AccessControl',
    //     'rules' => [
    //         [
    //             'allow' => true,
    //             'actions' => ['login', 'health', 'download-relatorio'],
    //         ],
    //         [
    //             'allow' => true,
    //             'roles' => ['@'],
    //         ],
    //     ],
    //     'denyCallback' => function () {
    //         return Yii::$app->response->redirect(['/site/login']);
    //     },
    // ],
    // force login ------------------------------------------------

    'params' => $params,
];

if (getenv('ENVIRONMENT') == 'DEV') {
    // configuration adjustments for 'dev' environment
    // $config['bootstrap'][] = 'debug';
    // $config['modules']['debug'] = [
    //     'class' => 'yii\debug\Module',
    //     // uncomment the following to add your IP if you are not connecting from localhost.
    //     'allowedIPs' => ['*'],
    // ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['*'],
    ];
}

return $config;
