<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Ligacoes */

$this->title = $model->rasao_social;
$this->params['breadcrumbs'][] = ['label' => 'Ligações', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ligacoes-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Alterar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
       
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
//            'id_usuario',
            ['attribute' => 'Vendedor', 'value' => $model->usuario->nome],
            'data',
            'horario',
            'ddd',
            'telefone',
            'cnpj',
            'rasao_social',
            'responsavel',
            'email:email',
            'retorno',
            'status',
            'data_retorno',
            'horario_retorno',
            'observacoes',
        ],
    ]) ?>

</div>
