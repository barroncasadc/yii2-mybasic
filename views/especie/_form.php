<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Especie */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="especie-form well">

    <?php
        $form = ActiveForm::begin([
        'id' => 'default-form',
        'options' => ['enctype'=>'multipart/form-data']
        ]);
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php
        echo $form->field($model, 'fami_codigo')->widget(Select2::classname(), [
            'data' => $dataFamilia,
            'language' => 'pt-br',
            'options' => [
                'id' => 'chosenFamilia',
                // 'placeholder' => 'Selecione a familia'
            ],
            'pluginOptions' => [
                // 'allowClear' => false
            ],
        ])->label('Selecione a familia');
    ?>

    <?php
        echo $form->field($model, 'gene_codigo')->widget(Select2::classname(), [
            'data' => $dataGenero,
            'language' => 'pt-br',
            'options' => [
                'id' => 'chosenGenero',
                // 'placeholder' => 'Selecione o genero'
            ],
            'pluginOptions' => [
                // 'allowClear' => false
            ],
        ])->label('Selecione o genero');
    ?>

    <?= $form->field($model, 'espe_nome')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'espe_imagem')->textInput(['maxlength' => true]) ?>

    <?php
        echo $form->field($model, 'espe_habilitado')->widget(Select2::classname(), [
            'data' => [1 => 'Habilitado', 0 => 'Desabilitado'],
            'language' => 'pt-br',
            'pluginOptions' => [],
        ])->label('Habilitado');
    ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
