<?php use yii\helpers\Html; use yii\widgets\DetailView; ?>

<?php
  // CREATE HEADERS
  $defaultLabel = Html::encode(strtoupper('pessoa'));
  $actualLabel  = Html::encode(strtoupper('visualizar'));
  $actionLabel  = Html::encode(strtoupper('visualizar'));
  $titleLabel   = Html::encode(strtoupper('visualizar: ' . $defaultLabel));
?>

<?php
  $this->title = $titleLabel;
  $this->params['breadcrumbs'][] = ['label' => $defaultLabel, 'url' => ['index']];
  $this->params['breadcrumbs'][] = $actionLabel;
?>

<div class="pessoa-view box">

    <div class="row">
        <div class="col-lg-6">
            <?php
                echo \app\widgets\formModel\FormModelWidget::widget([
                'type' => 3, // view
                'text' => $this->title,
                ])
            ?>
        </div>
        <div class="col-lg-6 text-right">
            <p>
                <?= Html::a('ATUALIZAR', ['update', 'id' => $model->pess_codigo], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('DELETAR', ['delete', 'id' => $model->pess_codigo], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Você deseja desabilitar o item selecionado?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>

    <div class="well">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'pess_codigo',
                'pess_nome',
                'pess_email:email',
                'pess_senha',
                'pess_token',
                'peti_codigo',
                'pess_imagem',
                'pess_habilitado',
                'pess_data_criacao',
                'pess_data_alteracao',
            ],
        ]) ?>
    </div>

</div>
