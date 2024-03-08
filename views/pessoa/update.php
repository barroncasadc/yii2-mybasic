<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pessoa */

$this->title = 'Atualizar Pessoa: ' . $model->pess_codigo;
$this->params['breadcrumbs'][] = ['label' => 'Pessoas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->pess_codigo, 'url' => ['view', 'id' => $model->pess_codigo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pessoa-update">

    <h4><?= Html::encode($this->title) ?></h4>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
