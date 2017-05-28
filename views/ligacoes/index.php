<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ligações';
$this->params['breadcrumbs'][] = $this->title;
//        echo date('YYYY:MM:DD', time());
?>
<div class="ligacoes-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if (!Yii::$app->user->getIdentity()->is_admin) : ?>
            <?= Html::a('Adicionar Ligação', ['create'], ['class' => 'btn btn-success']) ?>


        <?php endif; ?>
        <?= Html::a('Pesquisa Avançada', ['search'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Gerar CSV', ['csv'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php
    $collumns = [];



    $opts = [
        'class' => 'yii\grid\ActionColumn',
        'buttons' => [
            'update' => function($url, $model) {
                return Html::a('Alterar', $url, ['class' => 'btn btn-primary btn-sm']) . '<br> ';
            },
                    'view' => function($url, $model) {
                return Html::a('Detalhes', $url, ['class' => 'btn btn-success btn-sm']) . '<br> ';
            },
                ]
            ];


            if (Yii::$app->user->getIdentity()->is_admin) {
                $collumns[] = ['attribute' => 'usuario.nome', 'value' => 'usuario.nome', 'label' => 'Vendedor'];
                $opts['template'] = '{update}{view}';
            } else {
                $opts['buttons']['retornar'] = function($url, $model) {
                    return Html::a('Retornar', $url, ['class' => 'btn btn-primary btn-sm']);
                };
                $opts['template'] = '{update}{view}{retornar}';
            }

            $collumns = array_merge($collumns, [
                'data',
                'horario',
                'rasao_social',
                'retorno',
                'status',
                'data_retorno',
                'horario_retorno',
                $opts
            ]);

            $array = [
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $collumns,
                'summary' => 'Mostrando <strong>{begin}-{end}</strong> itens de <strong>{totalCount}</strong>:',
                'emptyText' => 'Nenhum item encontrado',
            ];
            ?>

            <?=
            GridView::widget($array);
            ?>

</div>
