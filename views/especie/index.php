<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EspecieSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Especies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="especie-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Especie', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'espe_codigo',
            'espe_uuid',
            'espe_nome',
            'fami_codigo',
            'gene_codigo',
            //'espe_habilitado',
            //'espe_data_criacao',
            //'espe_data_alteracao',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
