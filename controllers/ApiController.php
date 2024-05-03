<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

// ------
use yii\helpers\Json;
use yii\helpers\Url;
use yii\db\Expression;
use yii\helpers\ArrayHelper;
use yii\data\ArrayDataProvider;
// ------

// ------
use app\models\Familia;
use app\models\Genero;
use app\models\Especie;
// ------

use yii\web\Response;
use yii\web\MethodNotAllowedHttpException;

class ApiController extends Controller
{

    // Set the response format to JSON for all actions in this controller
    public function init()
    {
        parent::init();
        \Yii::$app->response->format = Response::FORMAT_JSON;
    }

    // Enforce POST method for create action
    public function beforeAction($action)
    {
        if ($action->id === 'delete' && Yii::$app->request->method !== 'POST') {
            throw new MethodNotAllowedHttpException('Method Not Allowed. This URL can only handle POST requests.');
        }

        return parent::beforeAction($action);
    }

    // Action to get all items
    public function actionIndex()
    {
        $items = Especie::find()->all();
        return $items;
    }

    // Action to get a single item by ID
    public function actionView($id)
    {
        $item = Especie::findOne($id);
        if ($item === null) {
            throw new NotFoundHttpException('Item not found');
        }
        return $item;
    }

    // Action to create a new item
    public function actionCreate()
    {
        $model = new Especie();
        // Populate $model attributes with POST data

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return ['success' => true, 'data' => $model];
        } else {
            return ['success' => false, 'errors' => $model->errors];
        }
    }

    // Action to update an existing item
    public function actionUpdate($id)
    {
        $model = Especie::findOne($id);
        // Populate $model attributes with PUT/PATCH data

        if ($model === null) {
            throw new NotFoundHttpException('Item not found');
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return ['success' => true, 'data' => $model];
        } else {
            return ['success' => false, 'errors' => $model->errors];
        }
    }

    // Action to delete an item
    public function actionDelete($id)
    {
        $model = Especie::findOne($id);
        if ($model === null) {
            throw new NotFoundHttpException('Item not found');
        }
        $model->delete();
        return ['success' => true];
    }

}