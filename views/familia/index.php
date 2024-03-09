<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FamiliaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Familias';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="familia-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Familia', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'fami_codigo',
            'fami_uuid',
            'fami_nome',

            [
                'label' => 'Criação',
                'attribute' => 'fami_data_criacao',
                'format' => ['date', 'php:d/m/Y']
            ],
        
            [
                'label' => 'Alteração',
                'attribute' => 'fami_data_alteracao',
                'format' => ['date', 'php:d/m/Y']
            ],

            [
                'contentOptions' => [],
                'attribute' => 'fami_habilitado',
                'label' => 'Habilitado',
                'format' => 'raw',
                'value'=>function($model){
                    if($model['fami_habilitado'] == 1){
                        return '<span class="btn btn-sm btn-success" role="alert">Sim</span>';
                    } else if($model['fami_habilitado'] == 0){
                        return '<span class="btn btn-sm btn-danger" role="alert">Não</span>';
                    }
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'header'=> 'Ações',
                'headerOptions' => ['width' => '130px', 'align' => 'center','style'=>'font-weight:bold; text-align:center; background:white !important;'],
                'contentOptions' => ['style'=>'text-align:center; vertical-align: middle;'],
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<i class="fa fa-eye bigger-120 icon-only"></i>', $url, [
                            'title' => 'Visualizar',
                            'data-pjax' => '0',
                            'class' => 'btn btn-info btn-sm'
                        ]);
                    },
                    'update' => function ($url, $model){
                        return Html::a('<i class="fa fa-pencil bigger-120 icon-only"></i>', $url, [
                            'title' => 'Alterar',
                            'data-pjax' => '0',
                            'class' => 'btn btn-primary btn-sm'
                        ]);
                    },
                    'delete' => function ($url, $model) {
                        $msg = 'Deseja desabilitar o grupo selecionado?';
                        return Html::a('<i class="fa fa-trash-o bigger-120 icon-only"></i>', $url, [
                            'title' => 'Desabilitar',
                            'class' => 'btn btn-danger btn-sm',
                            'data' => [
                                'confirm' => $msg,
                                'method' => 'post',
                            ],
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>


</div>
