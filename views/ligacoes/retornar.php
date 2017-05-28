<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ligacoes */

$this->title = 'Retornar Ligação: ' . $model->rasao_social;
$this->params['breadcrumbs'][] = ['label' => 'Ligações', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Alterar';
?>
<div class="ligacoes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'tipo' => 'retorno',
    ]) ?>

</div>
