<?php

namespace app\controllers;

use Yii;
use app\models\Especie;
use app\models\EspecieSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

use app\models\Familia;
use app\models\Genero;
use yii\helpers\ArrayHelper;

/**
 * EspecieController implements the CRUD actions for Especie model.
 */
class EspecieController extends Controller
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
     * Lists all Especie models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (!$this->checkPermission()) {
            return $this->render('/exception/forbidden');
        } else {
            $searchModel = new EspecieSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    /**
     * Displays a single Especie model.
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
     * Creates a new Especie model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!$this->checkPermission()) {
            return $this->render('/exception/forbidden');
        } else {
            $model = new Especie();

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->espe_codigo]);
            }

            return $this->render('create', [
                'model' => $model,
                'dataFamilia' => $this->getAllFamilia(),
                'dataGenero' => $this->getAllGenero(),
            ]);
        }
    }

    /**
     * Updates an existing Especie model.
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

            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->espe_codigo]);
            }

            return $this->render('update', [
                'model' => $model,
                'dataFamilia' => $this->getAllFamilia(),
                'dataGenero' => $this->getAllGenero(),
            ]);
        }
    }

    /**
     * Deletes an existing Especie model.
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
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }
    }

    /**
     * Finds the Especie model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Especie the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Especie::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    // @DESC retorna todos os modelos
    private function getAllFamilia()
    {
        $getData  = Familia::find()->where(['fami_habilitado' => 1])
        ->orderBy(['fami_nome'=>SORT_ASC,'fami_nome'=>SORT_ASC])
        ->all();
        return ArrayHelper::map($getData, 'fami_codigo', function($data){
            return ucfirst($data['fami_nome']);
        });
    }

    // @DESC retorna todos os modelos
    private function getAllGenero()
    {
        $getData  = Genero::find()->where(['gene_habilitado' => 1])
        ->orderBy(['gene_nome'=>SORT_ASC,'gene_nome'=>SORT_ASC])
        ->all();
        return ArrayHelper::map($getData, 'gene_codigo', function($data){
            return ucfirst($data['gene_nome']);
        });
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
