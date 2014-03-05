<?php

namespace frontend\controllers;

use kato\KatoController;
use backend\models\Page;
use yii\web\BadRequestHttpException;
use yii\helpers\HtmlPurifier;

class PageController extends KatoController
{
    /**
     * Displays a single Page model.
     * @return string
     * @throws \yii\web\BadRequestHttpException
     */
    public function actionView()
    {
        if (!isset($_GET['slug'])) {
            throw new BadRequestHttpException('Page slug not set.');
        }
        $model = Page::find()
            ->where(['slug' => HtmlPurifier::process($_GET['slug'])])
            ->one();

        if (!$model) {
            throw new BadRequestHttpException('Page not found!');
        }

        return $this->render('view', [
            'model' => $model,
        ]);
    }
}