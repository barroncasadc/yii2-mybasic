<?php

namespace app\controllers;

use Yii;
use app\models\Pessoa;
use app\models\PessoaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PessoaController implements the CRUD actions for Pessoa model.
 */
class PessoaController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Pessoa models.
     * @return mixed
     */
    public function actionIndex()
    {

        if (!$this->checkPermission()) {
            return $this->render('/exception/forbidden');
        } else {
            $searchModel = new PessoaSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single Pessoa model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (!$this->checkPermission()) {
            return $this->render('/exception/forbidden');
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Creates a new Pessoa model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!$this->checkPermission()) {
            return $this->render('/exception/forbidden');
        } else {
            $model = new Pessoa();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->pess_codigo]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Pessoa model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        if (!$this->checkPermission()) {
            return $this->render('/exception/forbidden');
        } else {
            $model = $this->findModel($id);
            $model->pess_senha = "";

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->pess_codigo]);
            }

            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Pessoa model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (!$this->checkPermission()) {
            return $this->render('/exception/forbidden');
        } else {
            // $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Pessoa model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Pessoa the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Pessoa::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // @DESC prevent unauthorized access
    // @DEC just logged and admin can access
    private function checkPermission() {
        // perfis permitidos
        if (\Yii::$app->user->identity->peti_codigo == 1) {
            return true;
        }
        return false;
    }
}
