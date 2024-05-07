<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Genero */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="genero-form well">

    <?php
        $form = ActiveForm::begin([
        'id' => 'default-form',
        'options' => ['enctype'=>'multipart/form-data']
        ]);
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?= $form->field($model, 'gene_nome')->textInput(['maxlength' => true]) ?>

    <?php
        echo $form->field($model, 'gene_habilitado')->widget(Select2::classname(), [
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
