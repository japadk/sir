<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\LigacoesSearch */
/* @var $form ActiveForm */

if ($what == 'csv') {
    $this->title = 'Gerar Csv';
} else {
    $this->title = 'Presquisa Avançada';
    
}
$this->title = 'Gerar Csv';
$this->params['breadcrumbs'][] = ['label' => 'Ligações', 'url' => ['index']];
if ($what == 'csv')
    $this->params['breadcrumbs'][] = 'Gerar Csv';
else
    $this->params['breadcrumbs'][] = 'Pesquisa Avançada';
?>

<h3><?php if (isset($message)) echo $message ?> </h3>

<div class="something">

    <?php
    if (isset($dataProvider)) {
//        echo '<br><br>';
        $collumns = [];
        if (Yii::$app->user->getIdentity()->is_admin) {
            $collumns[] = ['attribute' => 'nome', 'value' => 'nome', 'label' => 'Vendedor'];
        }
        $collumns = array_merge($collumns, [
            'data',
//            'lid',
            [ 'attribute' => 'horario', 'label' => 'Horário'],
            [ 'attribute' => 'ddd', 'label' => 'DDD'],
            'telefone',
            [ 'attribute' => 'cnpj', 'label' => 'CNPJ'],
            [ 'attribute' => 'rasao_social', 'label' => 'Rasão Social'],
            [ 'attribute' => 'responsavel', 'label' => 'Responsável'],
            'email:email',
            'retorno',
            'status',
            ['attribute' => 'data_retorno', 'label' => 'Data Retorno'],
            ['attribute' => 'horario_retorno', 'label' => 'Horário Retorno'],
            [ 'attribute' => 'observacoes', 'label' => 'Observações'],
            ['class' => 'yii\grid\ActionColumn',
                'buttons' => ['update' => function($url, $model) {
                        return Html::a('Alterar', 'update?id=' . $model['lid'], ['class' => 'btn btn-primary btn-sm']) . '&nbsp; ';
//                        return var_dump($model);
                    },
                            'view' => function($url, $model) {
                        return Html::a('Detalhes', 'view?id=' . $model['lid'], ['class' => 'btn btn-success btn-sm']);
                    },],
                        'template' => '{update}{view}'
                ]]);

                $array = [
                    'dataProvider' => $dataProvider,
                    'columns' => $collumns,
                    'summary' => 'Mostrando <strong>{begin}-{end}</strong> itens de <strong>{totalCount}</strong>:',
                    'emptyText' => 'Nenhum item encontrado',
                ];


                echo '<font size="2">';
                echo GridView::widget($array);
                echo '</font>';
            }
            ?>

            <div class="ligacoes-search">

                <?php $form = ActiveForm::begin(); ?>

                <?php if (Yii::$app->user->getIdentity()->is_admin): ?>
                    <?php echo $form->field($model, 'nome')->textInput() ?>
                <?php endif ?>
                <?php echo $form->field($model, 'data')->textInput()->label('Data | Modelo: AAAA-MM-DD') ?>
                <?php echo $form->field($model, 'horario')->textInput()->label('Horário | Modelo: HH:MM:SS') ?>
                <?php echo $form->field($model, 'ddd')->textInput() ?>
                <?php echo $form->field($model, 'telefone')->textInput() ?>
                <?php echo $form->field($model, 'cnpj')->textInput() ?>
                <?php echo $form->field($model, 'rasao_social')->textInput() ?>
                <?php echo $form->field($model, 'responsavel')->textInput() ?>
                <?php echo $form->field($model, 'email')->textInput() ?>
                <?php echo $form->field($model, 'retorno')->textInput() ?>
                <?php echo $form->field($model, 'status')->radioList(['Negado' => 'Negado', 'Vendido' => 'Vendido', 'Retorno' => 'Retorno', 'Pre-Venda' => 'Pré-Venda','Serasa'=>'Serasa']) ?>
                <?php echo $form->field($model, 'data_retorno')->textInput()->label('Data Retorno| Modelo: AAAA-MM-DD') ?>
                <?php echo $form->field($model, 'horario_retorno')->textInput()->label('Horário Retorno | Modelo: HH:MM') ?>

                <div class="form-group">
                    <?php if ($what == 'csv'): ?>
                        <?php echo Html::submitButton('Gerar', ['class' => 'btn btn-primary']) ?>
                    <?php else : ?>
                        <?php echo Html::submitButton('Buscar', ['class' => 'btn btn-primary']) ?>
                    <?php endif ?>
                </div>
                <?php ActiveForm::end(); ?>

    </div>

</div><!-- something -->
