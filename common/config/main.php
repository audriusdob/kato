<?php
return [
    'bootstrap' => [
        'media',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'extensions' => require(__DIR__ . '/../../vendor/yiisoft/extensions.php'),
    'modules' => [
        'markdown' => [
            // the module class
            'class' => 'kartik\markdown\Module',
            // the controller action route used for markdown editor preview
            'previewAction' => '/markdown/parse/preview',
            // the list of custom conversion patterns for post processing
            'customConversion' => [
                '<table>' => '<table class="table table-bordered table-striped">'
            ],
            // whether to use PHP SmartyPantsTypographer to process Markdown output
            'smartyPants' => false
        ],
        'media' => [
            'class' => 'kato\modules\media\Media',
            'adminLayout' => '@backend/views/layouts/main',
            'adminView' => '@backend/views/media/index',
        ],
        'tag' => [
            'class' => 'kato\modules\Tag',
        ],
        'menu' => [
            'class' => 'kato\modules\Menu',
        ],
        'setting' => [
            'class' => 'kato\modules\setting\Setting',
            'adminLayout' => '@backend/views/layouts/main',
        ],
    ],
    'components' => [
        'assetManager' => [
            'linkAssets' => true,
        ],
        'kato' => [
            'class' => 'kato\components\Kato',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'], //'admin', 'user'
            'itemTable' => 'kato_auth_item',
            'itemChildTable' => 'kato_auth_item_child',
            'assignmentTable' => 'kato_auth_assignment',
            'ruleTable' => 'kato_auth_rule',
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
        'urlManagerFrontend' => [
            // here is your frontend URL manager config
            'class' => 'yii\web\UrlManager',
            'baseUrl' => '/',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
        'urlManagerBackend' => [
            // here is your backend URL manager config
            'class' => 'yii\web\UrlManager',
            'baseUrl' => '/admin',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
        ],
    ],
];
