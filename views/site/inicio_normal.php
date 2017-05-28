<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>


<div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Ligações</h2>

                <p>Veja as ligações ja realizadas por você.</p>

                <p><a class="btn btn-success" href="<?php echo Yii::$app->urlManager->createUrl('ligacoes')?>">Ir para Ligações &raquo</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Alterar Senha</h2>

                <p>Altere sua senha se desejar. </p>

                <p><a class="btn btn-success" href="<?php echo Yii::$app->urlManager->createUrl('vendedor/senha')?>">Ir para Alteração de Senha &raquo;</a></p>
            </div>
            
        </div>

    </div>