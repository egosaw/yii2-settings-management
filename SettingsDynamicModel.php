<?php
/**
 * Created by PhpStorm.
 * User: egoss
 * Date: 29.07.17
 * Time: 15:38
 */

namespace egosaw\settings;


class SettingsDynamicModel extends \yii\base\DynamicModel
{
    public $attributeLabels = [];

    public function attributeLabels()
    {
        return $this->attributeLabels;
    }
}