<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\Select2;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Pessoa */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pessoa-form well">

    <?php
        $form = ActiveForm::begin([
        'id' => 'default-form',
        'options' => ['enctype'=>'multipart/form-data']
        ]);
    ?>

    <?php echo $form->errorSummary($model); ?>

    <?php
        // echo $form->field($model, 'peti_codigo')->widget(Select2::classname(), [
        //     'data' => [],
        //     'language' => 'pt-br',
        //     // 'theme' => Select2::THEME_KRAJEE,
        //     'options' => [
        //         'id' => 'chosenPeti',
        //         // 'placeholder' => 'Selecione o tipo'
        //     ],
        //     'pluginOptions' => [
        //         'allowClear' => false
        //     ],
        // ])->label('Tipo de usuário');
    ?>

    <?= $form->field($model, 'pess_nome')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pess_email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'pess_senha')->passwordInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'confirm_password')->passwordInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'pess_imagem')->textInput(['maxlength' => true]) ?>

    <?php // $form->field($model, 'pess_habilitado')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('ENVIAR', [
            'id'       => 'submitBtn',
            'class'    => 'btn-block btn btn-success'
        ]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
