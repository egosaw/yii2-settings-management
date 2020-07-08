<?php

namespace egosaw\settings;

use yii\base\DynamicModel;

/**
 * Class SettingsDynamicModel
 * @package egosaw\settings
 */
class SettingsDynamicModel extends DynamicModel
{
    /**
     * @var array
     */
    public $attributeLabels = [];

    /**
     * @return array
     */
    public function attributeLabels(): array
    {
        return $this->attributeLabels;
    }
}