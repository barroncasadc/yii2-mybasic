<?php use yii\helpers\Html; ?>

<?php
  // UPDATE HEADERS
  $defaultLabel = Html::encode(strtoupper('pessoa'));
  $actionLabel  = Html::encode(strtoupper('atualizar'));
  $actualLabel  = Html::encode(strtoupper(substr($model->pess_nome, 0, 50)));
  $titleLabel   = Html::encode(strtoupper('atualizar: ' . $defaultLabel));
  $codigo       = Html::encode(strtoupper($model->pess_codigo));
?>

<?php
  $this->title = $titleLabel;
  $this->params['breadcrumbs'][] = ['label' => $defaultLabel, 'url' => ['index']];
  $this->params['breadcrumbs'][] = ['label' => $actualLabel, 'url' => ['view', 'id' => $codigo]];
  $this->params['breadcrumbs'][] = $actionLabel;
?>

<div class="<?php echo $defaultLabel ?>-update box">

  <?php
    echo \app\widgets\formModel\FormModelWidget::widget([
      'type' => 2, // update
      'text' => $actualLabel,
    ])
  ?>

  <div class="box-body">
    <?= $this->render('_form', [
      'model' => $model
    ]) ?>
  </div>

</div>
