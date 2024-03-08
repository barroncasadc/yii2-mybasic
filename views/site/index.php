<?php

/** @var yii\web\View $this */
use yii\bootstrap4\Html;

$this->title = 'DiscusBrazil';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Congratulations!</h1>

        <p class="lead">You have successfully entered the best discus site in Brazil!</p>

        <p><a class="btn btn-lg btn-success" href="#">Get to know a little more</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heckel Cross </h2>

                <p>A variação Heckel Cross refere-se a um tipo específico de criação seletiva de Acarás Disco. Essa variedade é o resultado do cruzamento entre diferentes linhagens de Acarás Disco, incluindo os Discos selvagens Heckel e outras linhagens domesticadas.</p>

                <img class="logo-login" src="<?php echo Html::encode(yii::$app->ConvertToBase64->convertImage('3.jpg', 'images/img-discos')) ?>" alt="DiscusBrazil" title="DiscusBrazil" style="text-align:center; width: 60%; height: 60%; padding: 10px 0;">
            </div>
            <div class="col-lg-4">
                <h2>Orange Nhamunda</h2>

                <p>A variação Orange Nhamunda é uma linhagem específica de Acarás Disco que se originou da região do rio Nhamundá, na bacia amazônica. Esses Discos são conhecidos por sua coloração predominante em tons de laranja, que pode variar em intensidade e tonalidade dependendo da linhagem e das condições de criação.</p>

                <img class="logo-login" src="<?php echo Html::encode(yii::$app->ConvertToBase64->convertImage('1.jpg', 'images/img-discos')) ?>" alt="DiscusBrazil" title="DiscusBrazil" style="text-align:center; width: 60%; height: 60%; padding: 10px 0;">
            </div>
            <div class="col-lg-4">
                <h2>Green Semi Royal</h2>

                <p>A variação "Green Semi Royal" (ou "Semi Royal Green") é uma linhagem específica de Acarás Disco conhecida por sua coloração verde vibrante. Esses Discos geralmente exibem um verde intenso com nuances e padrões que podem variar de peixe para peixe.</p>

                <img class="logo-login" src="<?php echo Html::encode(yii::$app->ConvertToBase64->convertImage('4.jpg', 'images/img-discos')) ?>" alt="DiscusBrazil" title="DiscusBrazil" style="text-align:center; width: 60%; height: 60%; padding: 10px 0;">
            </div>
        </div>

    </div>
</div>
