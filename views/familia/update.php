<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Familia */

$this->title = 'Update Familia: ' . $model->fami_codigo;
$this->params['breadcrumbs'][] = ['label' => 'Familias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->fami_codigo, 'url' => ['view', 'id' => $model->fami_codigo]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="familia-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
