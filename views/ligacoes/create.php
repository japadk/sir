<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Ligacoes */

$this->title = 'Adicionar Ligação';
$this->params['breadcrumbs'][] = ['label' => 'Ligacões', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ligacoes-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
