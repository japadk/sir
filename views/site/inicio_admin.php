<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

?>



<div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Relatórios</h2>

                <p>Veja os relatórios de todos os vendedores.</p>

                <p><a class="btn btn-success" href="<?php echo Yii::$app->urlManager->createUrl('ligacoes')?>">Ir para Relatórios &raquo</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Vendedores</h2>

                <p>Adicionar ou alterar dados dos usuários dos vendedores. </p>

                <p><a class="btn btn-success" href="<?php echo Yii::$app->urlManager->createUrl('vendedor')?>">Ir para Vendedores &raquo;</a></p>
            </div>
            
            <div class="col-lg-4">
                <h2>Alterar Senha</h2>

                <p>Altere sua senha se desejar. </p>

                <p><a class="btn btn-success" href="<?php echo Yii::$app->urlManager->createUrl('vendedor/senha')?>">Ir para Alteração de Senha &raquo;</a></p>
            </div>
            
        </div>

    </div>