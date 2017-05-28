<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Vendedores';
$this->params['breadcrumbs'][] = $this->title;
//$model, $key, $index, $this
if (!isset($message)) {
    $message = '';
}
?>
<div class="usuario-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <h2><?= Html::encode($message)?></h2>

    <p>
        <?= Html::a('Criar Vendedores', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    echo
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'id',
            'nome',
            'usuario',
//            'senha',
//            'authKey',
            ['attribute' => 'ativo'
                , 'value' => function($model) {
                    return $model->ativo ? 'Sim' : 'Não';
                }],
            // 'is_admin',
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => ['update' => function($url, $model) {
                        return Html::a('Alterar', $url, ['class' => 'btn btn-primary btn-sm']).'&nbsp; ';
                    },
                    'senha-vendedor' => function($url, $model) {
                        return Html::a('Mudar Senha', $url, ['class' => 'btn btn-success btn-sm']);
                    }
                ],
                'template' => '{update}{senha-vendedor}'
            ],
        ],
        'summary' => 'Mostrando <strong>{begin}-{end}</strong> itens de <strong>{totalCount}</strong>:',
        'emptyText' => 'Nenhum item encontrado',
    ]);
    ?>

</div>
