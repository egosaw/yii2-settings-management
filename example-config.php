<?php
/**
 * Created by PhpStorm.
 * User: egoss
 * Date: 29.07.17
 * Time: 14:51
 */

use kartik\builder\Form;
use kartik\file\FileInput;


$settings = Yii::$app->settings;

return [
    'title'      => Yii::t('app', 'Site settings'),
    'section'    => 'site',
    'uploads'    => [
        'logo' => [
            //Yii::setAlias('@uploads', __DIR__ . '/../../www/uploads');
            'path'     => '@uploads/site',
            'view'     => '/uploads/site',
            'filename' => 'logo'
        ]
    ],
    'attributes' => [
        'username',
        'email',
        'robots',
        'logo',
    ],
    'rules'      => [
        [['username', 'robots'], 'safe'],
        [['email'], 'email'],
        [['logo'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
    ],
    'labels'     => [
        'username' => Yii::t('app', 'Имя пользователя'),
        'email'    => Yii::t('app', 'Email пользователя'),
        'robots'   => Yii::t('app', 'Robots.txt'),
        'logo'     => Yii::t('app', 'Logo'),
    ],
    'rows'       => [
        [
            'columns'    => 2,
            'attributes' => [
                'username' => [
                    'type'    => Form::INPUT_TEXT,
                    'label'   => 'User name',
                    'options' => ['placeholder' => 'Enter username...']
                ],
                'email'    => ['type' => Form::INPUT_TEXT, 'options' => ['placeholder' => 'Enter email...']],
                'robots'   => ['type' => Form::INPUT_TEXTAREA, 'options' => ['placeholder' => 'robots txt']],
            ]
        ],
        [
            'columns'    => 2,
            'attributes' => [
                'logo' => [
                    'type'        => Form::INPUT_WIDGET,
                    'widgetClass' => FileInput::className(),
                    'options'     => [
                        'options'       => [
                            'multiple' => false
                        ],
                        'pluginOptions' => [
                            'initialPreview'       => [
                                $settings->get('site', 'logo')
                            ],
                            'initialPreviewAsData' => true,
                            'initialCaption'       => "Logo fot this site",
                            'overwriteInitial'     => true,
                            'maxFileSize'          => 2800
                        ]
                    ]
                ],
            ]
        ],
    ],
];