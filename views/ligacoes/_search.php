<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LigacoesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ligacoes-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php $form->field($model, 'id') ?>

    <?php $form->field($model, 'usuario.nome') ?>

    <?php echo $form->field($model, 'data') ?>

    <?php echo $form->field($model, 'horario') ?>

    <?php echo $form->field($model, 'ddd') ?>

    <?php  echo $form->field($model, 'telefone') ?>

    <?php  echo $form->field($model, 'cnpj') ?>

    <?php  echo $form->field($model, 'rasao_social') ?>

    <?php  echo $form->field($model, 'responsavel') ?>

    <?php  echo $form->field($model, 'email') ?>
    
    <?php  echo $form->field($model, 'retorno') ?>

    <?php  echo $form->field($model, 'status') ?>
    
    <?php  echo $form->field($model, 'data_retorno') ?>
    
    <?php  echo $form->field($model, 'horario_retorno') ?>

    <?php  echo $form->field($model, 'observacoes') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
