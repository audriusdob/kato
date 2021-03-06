<?php

namespace backend\controllers;

use Yii;
use backend\models\Page;
use backend\models\search\PageSearch;
use yii\grid\DataColumn;
use yii\web\HttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\widgets\Block;

/**
 * PageController implements the CRUD actions for Page model.
 */
class PageController extends \yii\web\Controller
{
    public $pageTitle = 'Pages';
    public $pageIcon = 'fa fa-th';

	public function behaviors()
	{
		return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'create', 'update', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index', 'create', 'update', 'delete'], // Define specific actions
                        'allow' => true, // Has access
                        'roles' => ['admin'], // '@' All logged in users / or your access role e.g. 'admin', 'user'
                    ],
                    [
                        'allow' => false, // Do not have access
                        'roles'=>['?'], // Guests '?'
                    ],
                ],
            ],
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}

	/**
	 * Lists all Page models.
	 * @return mixed
	 */
	/**
	 * Lists all Page models.
	 * @return mixed
	 */
	public function actionIndex()
	{
        $controllerName = $this->getUniqueId();

        $meta['title'] = $this->pageTitle;
        $meta['description'] = 'List all pages';
        $meta['pageIcon'] = $this->pageIcon;

		return $this->render('index', [
            'controllerName' => $controllerName,
            'meta' => $meta,
		]);
	}

    /**
     * Creates a new Page model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @throws HttpException
     */
	public function actionCreate()
	{
		$model = new Page;

		if ($model->save(false)) {
			return $this->redirect(['update', 'id' => $model->id]);
		} else {
            throw new HttpException(500, 'Unable to insert page.');
        }
	}

	/**
	 * Updates an existing Page model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
        $controllerName = $this->getUniqueId();

        $meta['title'] = $this->pageTitle;
        $meta['description'] = 'Update page';
        $meta['pageIcon'] = $this->pageIcon;

        if (Yii::$app->request->post() && Yii::$app->params['createRevisions']) {
            //create revision
            $model->createRevision();
        }

        //update blocks
        $model->updateBlocks();

        //load blocks
        $model->loadBlocks();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Page has been updated');
			return $this->redirect(['update', 'id' => $model->id]);
		} else {
			return $this->render('/global/update', [
				'model' => $model,
                'meta' => $meta,
                'controllerName' => $controllerName,
			]);
		}
	}

    public function actionRestore($id)
    {
        $revision = $this->findModel($id);

        if ($revision->restore()) {
            return $this->redirect(['update', 'id' => $revision->revision_to]);
        } else {
            throw new HttpException(500, 'Unable to restore page.');
        }
    }

	/**
	 * Deletes an existing Page model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Page has been deleted');

		return $this->redirect(['index']);
	}

	/**
	 * Finds the Page model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return Page the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = Page::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
