<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

   <div class="row" sxtyle="margin-top: 5em;">
      <div class="col-lg-5 col-lg-offset-4" >

         <div style="text-align:center">
            <a href="<?= Yii::$app->urlManager->createUrl(['site/index']) ?>">
               <img class="logo-login" src="<?php echo Html::encode(yii::$app->ConvertToBase64->convertImage('logo.jpg', 'images/img-site')) ?>" alt="DiscusBrazil" title="DiscusBrazil" style="text-align:center; width: 35%; height: 35%; padding: 10px 0;">
            </a>
            <p style="color: #333" >
               Preencha seus dados para acessar sua conta
            </p>
         </div>

         <div class="well" stylXe="background: #fbfef3; padding: 10px; border: 1px solid #bbb; border-radius: 5px;">

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
                      'disabled' => 'disabled',
                      'class'    => 'btn-block btn btn-success'
                  ]) ?>
              </div>

           <?php ActiveForm::end(); ?>

         </div>

      </div>
   </div>

<script>
    function recaptchaCallback() {
        $('#submitBtn').removeAttr('disabled');
    }
</script>