<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PessoaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pessoa-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'pess_codigo') ?>

    <?= $form->field($model, 'pess_nome') ?>

    <?= $form->field($model, 'pess_email') ?>

    <?= $form->field($model, 'pess_senha') ?>

    <?= $form->field($model, 'pess_token') ?>

    <?php // echo $form->field($model, 'peti_codigo') ?>

    <?php // echo $form->field($model, 'pess_imagem') ?>

    <?php // echo $form->field($model, 'pess_habilitado') ?>

    <?php // echo $form->field($model, 'pess_data_criacao') ?>

    <?php // echo $form->field($model, 'pess_data_alteracao') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
