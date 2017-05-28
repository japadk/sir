<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

use yii\helpers\Html;
use app\models\Usuario;

$this->title = 'Início';
if (!isset($message)) {
    $message = '';
}
?>

<h1><?= Html::encode($this->title) ?></h1>
<h2><?= Html::encode($message)?></h2>

<?php
if (Yii::$app->user->getIdentity()->is_admin)
    require ('inicio_admin.php');
else
    require('inicio_normal.php');
?>


