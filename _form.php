<?php
/**
 * Created by PhpStorm.
 * User: egoss
 * Date: 29.07.17
 * Time: 14:29
 */

use kartik\form\ActiveForm;
use kartik\builder\Form;
use yii\bootstrap\Alert;
use yii\helpers\Html;

if (Yii::$app->session->hasFlash('SettingsDynamicModel')) {
    echo Alert::widget([
        'options' => ['class' => 'alert-info'],
        'body'    => Yii::$app->session->getFlash('SettingsDynamicModel'),
    ]);
}

$form = ActiveForm::begin();

echo Form::widget([
    'model'      => $model,
    'form'       => $form,
    'attributes' => $attributes
]);

echo Html::submitButton('Save', ['class' => 'btn btn-primary']);

ActiveForm::end();