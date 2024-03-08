<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PessoaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pessoas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pessoa-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Pessoa', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'pess_codigo',
            'pess_nome',
            'pess_email:email',
            'pess_senha',
            'pess_token',
            //'peti_codigo',
            //'pess_imagem',
            //'pess_habilitado',
            //'pess_data_criacao',
            //'pess_data_alteracao',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
