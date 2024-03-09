<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Especie */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="especie-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'espe_uuid')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'espe_nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fami_codigo')->textInput() ?>

    <?= $form->field($model, 'gene_codigo')->textInput() ?>

    <?= $form->field($model, 'espe_habilitado')->textInput() ?>

    <?= $form->field($model, 'espe_data_criacao')->textInput() ?>

    <?= $form->field($model, 'espe_data_alteracao')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
