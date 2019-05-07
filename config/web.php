<?php

$params = require __DIR__ . '/params.php';
$db     = require __DIR__ . '/db.php';
require_once __DIR__ . '/functions.php';//pd(dirname(dirname(__DIR__ )));
$config = [
    'id'           => 'basic',
    'basePath'     => dirname(__DIR__),
    'timeZone'     => 'PRC',
    'bootstrap'    => ['log'],
    'aliases'      => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        //'@yii' =>'syyd',
        //'@app' => 'sdww'
    ],
    'defaultRoute' => 'user/index/index',
    'components'   => [
        'request'      => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey'  => 'b7MamFa4VDOtssSfjaISDJ4ROzr6PzSR',
            'enableCsrfValidation' => false
        ],
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],
        'user'         => [
            'identityClass'   => 'app\models\db\SailCompany',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer'       => [
            'class'            => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db'           => $db,
        'redis'        => [
            'class'    => 'yii\redis\Connection',
            'hostname' => '192.168.1.254',
            'port'     => 6379,
            'password' => 'LJ31HT0we491',
        ],
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => true,
            'rules'           => [
                "http://<name:\w+>.{$params['hostName']}/user/user/index"  => '/user/user/index',
                "http://<name:\w+>.{$params['hostName']}/user/index/index" => '/user/index/index',
            ],
        ],

    ],
    'params'       => $params,
    'modules'      => array(
        'user'  => array(
            'class' => 'app\modules\user\Module'
        ),
        'admin' => array(
            'class' => 'app\modules\admin\Module'
        ),
    )
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][]      = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][]    = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
