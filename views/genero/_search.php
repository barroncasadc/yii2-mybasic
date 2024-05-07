<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\GeneroSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="genero-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'gene_codigo') ?>

    <?= $form->field($model, 'gene_uuid') ?>

    <?= $form->field($model, 'gene_nome') ?>

    <?= $form->field($model, 'gene_habilitado') ?>

    <?= $form->field($model, 'gene_data_criacao') ?>

    <?php // echo $form->field($model, 'gene_data_alteracao') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
