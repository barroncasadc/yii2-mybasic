<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Especie */

$this->title = 'Update Especie: ' . $model->espe_codigo;
$this->params['breadcrumbs'][] = ['label' => 'Especies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->espe_codigo, 'url' => ['view', 'id' => $model->espe_codigo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="especie-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'dataFamilia' => $dataFamilia,
        'dataGenero' => $dataGenero,
    ]) ?>

</div>
