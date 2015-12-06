<?php

$config = [
    'id' => 'rgk_books',
    'basePath' => dirname(__DIR__),
    'language' => 'ru-RU',
    'timeZone' => 'Europe/Kiev',
    'components' => [
        'formatter' => [
            'dateFormat' => 'd F Y',
            'timeFormat' => 'H:i:s',
            'datetimeFormat' => 'd F Y H:i:s',
        ],
        'request' => [
            'cookieValidationKey' => 'mysecretbookkey',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'db' => require(__DIR__ . '/db.php'),
    ],
];

if (YII_ENV_DEV) {
    
    // configuration adjustments for 'dev' environment

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;