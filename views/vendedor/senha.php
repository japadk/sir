<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Usuario */
/* @var $form yii\widgets\ActiveForm */
?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'senha1')->textInput(['maxlength' => 60])->passwordInput() ?>

<?= $form->field($model, 'senha2')->textInput(['maxlength' => 60])->passwordInput() ?>



<div class="form-group">
<?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
