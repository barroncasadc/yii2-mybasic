<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Pessoa */

$this->title = 'Cadastra Usuário';
$this->params['breadcrumbs'][] = ['label' => 'Pessoas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pessoa-create">

    <h4><?= Html::encode($this->title) ?></h4>
    <hr>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
