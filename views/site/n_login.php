<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Login - DiscusBrazil';
$this->params['breadcrumbs'][] = $this->title;
?>

<style>
    /* Estilo para a imagem ocupando 100% */
    .login-image {
      height: auto;
      max-width: 100%;
    }
  </style>

<div class="container mt-5">
  <div class="row">
    <div class="col-md-6">
      <!-- Coluna para o formulário de login -->
      <div class="card">
        <div class="card-body">
          <h3 class="card-title">Login</h3>

          <?php
                $form = ActiveForm::begin([
                'id' => 'default-form',
                // 'options' => ['enctype'=>'multipart/form-data']
                ]);
            ?>

             <?= $form->field($model, 'email')->textInput(['autocomplete' => 'on', 'autofocus' => true])->label('E-mail:') ?>

             <?= $form->field($model, 'senha')->passwordInput(['autocomplete' => 'on'])->label('Senha:') ?>

              <div  class="g-recaptcha" data-callback="recaptchaCallback" data-sitekey='<?= Yii::$app->RequestPath->googleRCaptchaPublic() ?>'></div>
              <br>

              <div class="form-group">
                  <?= Html::submitButton('ENVIAR', [
                      'id'       => 'submitBtn',
                      'class'    => 'btn-block btn btn-success'
                  ]) ?>
              </div>

           <?php ActiveForm::end(); ?>

        </div>
      </div>
    </div>
    <div class="col-md-6">
      <!-- Coluna para a imagem -->
      <img class="login-image" src="<?php echo Html::encode(yii::$app->ConvertToBase64->convertImage('background.jpg', 'images/img-site')) ?>" alt="DiscusBrazil" title="DiscusBrazil">
    </div>
  </div>
</div>
