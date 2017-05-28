<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Ligacoes */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ligacoes-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ddd')->textInput(['maxlength' => 2]) ?>

    <?= $form->field($model, 'telefone')->textInput(['maxlength' => 10]) ?>

    <?= $form->field($model, 'cnpj')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'rasao_social')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'responsavel')->textInput(['maxlength' => 30]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'status')->radioList(['Negado'=>'Negado','Vendido'=>'Vendido','Retorno'=>'Retorno','Pre-Venda'=>'Pré-Venda','Serasa'=>'Serasa']) ?>
    
    <?= $form->field($model, 'data_retorno')->textInput(['maxlength' => 50])->label('Data Retorno | Ex : AAAA-MM-DD') ?>
    
    <?= $form->field($model, 'horario_retorno')->textInput(['maxlength' => 50])->label('Horário Retorno | Ex : HH:MM') ?>

    <?= $form->field($model, 'observacoes')->textarea(['rows' => 6]) ?>

    
    <?php if(isset($tipo) && $tipo === 'retorno'):?>
    <div class="form-group">
        <?= Html::submitButton('Retornar',['class' =>  'btn btn-success']) ?>
    </div>
    <?php    else: ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Adicionar' : 'Alterar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    <?php endif;?>

    <?php ActiveForm::end(); ?>

</div>
