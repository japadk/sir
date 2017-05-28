<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nome')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'usuario')->textInput(['maxlength' => 30]) ?>
    
    <?php if(!$model->isNewRecord): ?>
    <?= $form->field($model, 'ativo')->textInput()->checkbox(['Não','Sim']) ?>
    <?php else :?>
    <?= $form->field($model, 'senha')->textInput(['maxlength' => 64])->passwordInput() ?>
    <?php endif ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Criar' : 'Alterar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
