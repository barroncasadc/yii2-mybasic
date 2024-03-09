<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Genero */

$this->title = 'Update Genero: ' . $model->gene_codigo;
$this->params['breadcrumbs'][] = ['label' => 'Generos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->gene_codigo, 'url' => ['view', 'id' => $model->gene_codigo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="genero-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
