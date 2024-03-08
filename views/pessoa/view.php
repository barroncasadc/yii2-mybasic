<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Pessoa */

$this->title = $model->pess_codigo;
$this->params['breadcrumbs'][] = ['label' => 'Pessoas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="pessoa-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->pess_codigo], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->pess_codigo], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'pess_codigo',
            'pess_nome',
            'pess_email:email',
            'pess_senha',
            'pess_token',
            'peti_codigo',
            'pess_imagem',
            'pess_habilitado',
            'pess_data_criacao',
            'pess_data_alteracao',
        ],
    ]) ?>

</div>
