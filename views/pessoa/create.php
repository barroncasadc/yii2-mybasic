<?php use yii\helpers\Html; ?>

<?php
  // CREATE HEADERS
  $defaultLabel = Html::encode(strtoupper('pessoa'));
  $actualLabel  = Html::encode(strtoupper('cadastrar'));
  $actionLabel  = Html::encode(strtoupper('cadastrar'));
  $titleLabel   = Html::encode(strtoupper('cadastrar: ' . $defaultLabel));
?>

<?php
  $this->title = $titleLabel;
  $this->params['breadcrumbs'][] = ['label' => $defaultLabel, 'url' => ['index']];
  $this->params['breadcrumbs'][] = $actionLabel;
?>

<div class="<?php echo $defaultLabel ?>-create box">

    <?php
        echo \app\widgets\formModel\FormModelWidget::widget([
        'type' => 1, // create
        'text' => strtoupper($actualLabel),
        ])
    ?>

    <div class="box-body">
        <?= $this->render('_form', [
            'model' => $model
        ]) ?>
    </div>

</div>