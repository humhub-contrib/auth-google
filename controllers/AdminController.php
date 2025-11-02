<?php

namespace humhubContrib\auth\moodle\controllers;

use Yii;
use humhub\modules\admin\components\Controller;
use humhubContrib\auth\moodle\models\ConfigureForm;

/**
 * Module configuration controller for Moodle authentication
 */
class AdminController extends Controller
{
    /**
     * Render admin configuration page
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = ConfigureForm::getInstance();

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->saveSettings()) {
            $this->view->saved();
        }

        return $this->render('index', ['model' => $model]);
    }

}
