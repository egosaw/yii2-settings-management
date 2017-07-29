<?php
/**
 * Created by PhpStorm.
 * User: egoss
 * Date: 29.07.17
 * Time: 14:21
 */

namespace egosaw\settings;

use Yii;
use yii\base\Action;
use yii\base\ErrorException;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

class SettingsAction extends Action
{
    public $config;

    public $view = '@vendor/egosaw/yii2-settings-management/_form';

    protected $model;

    protected $attributes;

    public function init()
    {
        $config_path = Yii::getAlias($this->config) . '.php';

        if (!file_exists($config_path))
            throw new ErrorException('Config file not exists');

        // load configuration
        $config = require($config_path);

        // load settings
        $settings = Yii::$app->settings;

        // set title
        $this->controller->view->title = $config['title'];

        // set bread crumbs
        // ...

        // prepare attributes
        $attributes = [];

        foreach ($config['attributes'] AS $attribute) {
            $attributes[$attribute] = Yii::$app->settings->get($config['section'], $attribute);
        }

        // create model
        $model = new SettingsDynamicModel($attributes);

        // adding validation rules
        foreach ($config['rules'] AS $rule) {

            $attributes = $rule[0];
            $validator = $rule[1];

            unset($rule[0]);
            unset($rule[1]);

            $options = $rule;

            $model->addRule($attributes, $validator, $options);
        }

        // set labels
        $model->attributeLabels = $config['labels'];

        // save
        if ($model->load(Yii::$app->request->post()) AND $model->validate()) {

            // upload files
            foreach ($config['uploads'] AS $attribute => $params) {

                $file = UploadedFile::getInstance($model, $attribute);

                if ($file === null)
                    continue;

                $directory = Yii::getAlias($params['path']);

                if (!file_exists($directory))
                    FileHelper::createDirectory($directory, $mode = 0775, $recursive = true);

                $filename = $params['filename'] . '.' . $file->extension;
                $path = $directory . '/' . $filename;

                $file->saveAs($path);

                // update attribute
                $model->{$attribute} = $params['view'] . '/' . $filename;
            }

            // save data
            foreach ($model->attributes AS $attribute => $value) {
                $settings->set($config['section'], $attribute, $value);
            }

            Yii::$app->session->setFlash('SettingsDynamicModel', 'Saved');

            $this->controller->refresh();
            Yii::$app->end();
        }

        $this->model = $model;
        $this->attributes = $config['rows'];
    }

    public function run()
    {
        return $this->controller->render($this->view, [
            'model'      => $this->model,
            'attributes' => $this->attributes,
        ]);
    }
}