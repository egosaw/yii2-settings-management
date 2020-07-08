<?php
/**
 * @var array $attributes
 */

use kartik\form\ActiveForm;
use kartik\builder\Form;
use yii\bootstrap\Alert;
use yii\helpers\Html;

if (Yii::$app->session->hasFlash('SettingsDynamicModel')) {
    echo Alert::widget([
        'options' => ['class' => 'alert-info'],
        'body' => Yii::$app->session->getFlash('SettingsDynamicModel'),
    ]);
}
?>
<div class="settings-update">
    <div class="panel panel-default half">
        <div class="panel-body">
            <?php

            $form = ActiveForm::begin();

            echo Form::widget([
                'model' => $model,
                'form' => $form,
                'attributes' => $attributes
            ]);

            echo Html::submitButton('Сохранить', ['class' => 'btn btn-success']);

            ActiveForm::end();
            ?>
        </div>
    </div>
</div>
