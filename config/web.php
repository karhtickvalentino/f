<?php

$params = require(__DIR__ . '/params.php');

$config = [
// 'session' => [
//     'class' => 'yii\web\DbSession',
//     'writeCallback' => function ($session) {
//         return [
//            'user_id' => Yii::$app->user->id,
//            'last_write' => time(),
//         ];
//     },
// ],
    'id' => 'basic',
    'basePath' => dirname(__DIR__),

   // 'bootstrap' => ['simplechat'],
   
    'modules' => [
    //  'chat' => [
    //         'class' => 'slavkovrn\chat\ChatModule',
    //         'numberLastMessages' => 30,
    //     ],
    // 'simplechat' => [
    //         'class' => 'bubasuma\simplechat\Module',
    //     ],
    // 'message' => [
    //     'class' => 'thyseus\message\Module',
    //     'userModelClass' => '\app\models\User', // your User model. Needs to be ActiveRecord.
    // ],
    
        'user-management' => [
        'class' => 'webvimark\modules\UserManagement\UserManagementModule',

         'enableRegistration' => true,

        // Add regexp validation to passwords. Default pattern does not restrict user and can enter any set of characters.
        // The example below allows user to enter :
        // any set of characters
        // (?=\S{8,}): of at least length 8
        // (?=\S*[a-z]): containing at least one lowercase letter
        // (?=\S*[A-Z]): and at least one uppercase letter
        // (?=\S*[\d]): and at least one number
        // $: anchored to the end of the string

        //'passwordRegexp' => '^\S*(?=\S{8,})(?=\S*[a-z])(?=\S*[\d])\S*$^',
        

        // Here you can set your handler to change layout for any controller or action
        // Tip: you can use this event in any module
        'on beforeAction'=>function(yii\base\ActionEvent $event) {
                if ( $event->action->uniqueId == 'user-management/auth/login' )
                {
                    $event->action->controller->layout = 'loginLayout.php';
                };
            },
    ],

    ],
    'components' => [
                        'session' => [
                        'class' => 'yii\web\DbSession',
                        // 'db' => 'mydb',
                        // 'sessionTable' => 'my_session',
                        'writeCallback' => function($session){
                            return [
                                'user_id' => Yii::$app->user->id,
                                'last_write' => time(),
                            ];
                        }
                    ],

                  'DbHttpSession' => [
                  'class' => 'components\DbHttpSession',
                  'connectionID' => 'db',
                  //'sessionTableName' => 'session',
                  'userTableName' => 'user'
                ],


                'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => 'mail',
            'useFileTransport' => false,//to send mails to real email addresses else will get stored in your mail/runtime folder
            //comment the following array to send mail using php's mail function
             'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'admin@metrimap.com',
                'password' => 'metrigmail',
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],

        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ksbbdkaskdjbsakjdbugbfequqlcpmnurjd',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
       'user' => [
        'class' => 'webvimark\modules\UserManagement\components\UserConfig',

        // Comment this if you don't want to record user logins
        'on afterLogin' => function($event) {
                \webvimark\modules\UserManagement\models\UserVisitLog::newVisitor($event->identity->id);
            }
    ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
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
        'db' => require(__DIR__ . '/db.php'),
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;
