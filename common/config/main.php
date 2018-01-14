<?php
/*
 * 该文件中的配置，在前、后端都有效
 * */
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'zh-CN',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        /*配合.htaccess美化路由*/
        'urlManager' =>[
            'enablePrettyUrl' =>true,
            'showScriptName' =>false,
            //'suffix' => '.html'
        ],
        'i18n' =>[
            'translations' =>[
                '*' => [
                    'class' =>'yii\i18n\PhpMessageSource',
                    //'basePath' =>'/messages',
                    'fileMap' =>['common' => 'common.php',
                        'test'=>'test.php'],
                ]
            ]
        ]
    ],

];
