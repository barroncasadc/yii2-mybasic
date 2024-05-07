<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\FamiliaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="familia-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'fami_codigo') ?>

    <?= $form->field($model, 'fami_uuid') ?>

    <?= $form->field($model, 'fami_nome') ?>

    <?= $form->field($model, 'fami_habilitado') ?>

    <?= $form->field($model, 'fami_data_criacao') ?>

    <?php // echo $form->field($model, 'fami_data_alteracao') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
