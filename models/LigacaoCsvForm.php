<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
namespace app\models;
use Yii;
use yii\base\Model;

/**
 * Description of LigacaoCsvForm
 *
 * @author Marcelo
 */
class LigacaoCsvForm extends Model {

    public $nome;
    public $data;
    public $horario;
    public $ddd;
    public $telefone;
    public $cnpj;
    public $rasao_social;
    public $responsavel;
    public $email;
    public $retorno;
    public $status;
    public $data_retorno;
    public $horario_retorno;
    
    public function attributeLabels()
    {
        return [
            'nome' => 'Vendedor',
            'data' => 'Data',
            'horario' => 'Horário',
            'ddd' => 'DDD',
            'telefone' => 'Telefone',
            'cnpj' => 'CNPJ',
            'rasao_social' => 'Rasão Social',
            'responsavel' => 'Responsável',
            'email' => 'E-mail',
            'status' => 'Status',
            'data_retorno' => 'Data Retorno',
            'horario_retorno' => 'Horário Retorno',
            'retorno' => 'Retorno de',
        ];
    }
    
    public function rules(){
        return [
            [['nome','data','horario','ddd','telefone','cnpj','rasao_social','responsavel','email','status','data_retorno','horario_retorno'],'safe']
        ];
    }

}

?>
