<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\EspecieSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="especie-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'espe_codigo') ?>

    <?= $form->field($model, 'espe_uuid') ?>

    <?= $form->field($model, 'espe_nome') ?>

    <?= $form->field($model, 'fami_codigo') ?>

    <?= $form->field($model, 'gene_codigo') ?>

    <?php // echo $form->field($model, 'espe_habilitado') ?>

    <?php // echo $form->field($model, 'espe_data_criacao') ?>

    <?php // echo $form->field($model, 'espe_data_alteracao') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
