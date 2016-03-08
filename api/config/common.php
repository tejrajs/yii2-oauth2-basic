<?php
Yii::setAlias('api', dirname(__DIR__));
$params = require(__DIR__ . '/params.php');
$config =  [
	'version' => "0.0.1",
    'basePath' => dirname(__DIR__),
	'timeZone' => 'Africa/Nairobi',

	'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',

	'bootstrap' => ['log','oauth2'],
    'modules' => [
        'gii' => [ //for development only
            'class' => 'yii\gii\Module',
        ],
    	'user' => [
    		'class' => 'api\modules\user\Module',
    	],
// 		'oauth2' => [
// 			'class' => 'api\modules\oauth2server\Module',
// 			'options' => [
// 				'token_param_name' => 'access_token',
// 				'access_lifetime' => 3600 * 24
// 			],
// 			'storageMap' => [
// 				'user_credentials' => 'api\models\User'
// 			],
// 			'grantTypes' => [
// 				'authorization_code' => [
// 					'class' => 'OAuth2\GrantType\AuthorizationCode',
// 				],
// 				'client_credentials' => [
// 					'class' => 'OAuth2\GrantType\ClientCredentials',
// 					'allow_public_clients' => false
// 				],
// 				'user_credentials' => [
// 					'class' => 'OAuth2\GrantType\UserCredentials'
// 				],
// 				'refresh_token' => [
// 					'class' => 'OAuth2\GrantType\RefreshToken',
// 					'always_issue_new_refresh_token' => true
// 				]
// 			],
// 		],
    	'oauth2' => [
    			'class' => 'api\modules\oauth2server\Module',
    			'tokenParamName' => 'accessToken',
    			'tokenAccessLifetime' => 3600 * 24,
    			'storageMap' => [
    					'user_credentials' => 'api\models\User',
    			],
    			'grantTypes' => [
    					'user_credentials' => [
    							'class' => 'OAuth2\GrantType\UserCredentials',
    					],
    					'refresh_token' => [
    							'class' => 'OAuth2\GrantType\RefreshToken',
    							'always_issue_new_refresh_token' => true
    					]
    	
    			]
    	],
		'v1' => [
			'class' => 'api\versions\v1\Module',
		],

	],
    'components' => [
    		'request' => [
    				// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
    				'cookieValidationKey' => 'w3*GTEE$%#WSRES4S5r6T&^%&RDSss',
    		],
		'db' => [
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=localhost;dbname=hosannah_app',
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		],
		'authManager' => [
			'class' => 'yii\rbac\DbManager',
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
    ],
    'params' => $params,
];

/*
if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}*/

return $config;