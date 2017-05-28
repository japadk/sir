<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class SenhaForm extends Model {

    public $senha1;
    public $senha2;
    public $id;

    public function rules() {
        return [ [['senha1', 'senha2'], 'required', 'message' => '{attribute} é um campo obrigatório'],
            [['senha2'], 'compare', 'compareAttribute' => 'senha1', 'operator' => '==', 'message' => 'As senhas não são as mesmas.'],
            ['id','safe'],
        ];
    }

    public function attributeLabels() {
        return ['senha1' => 'Nova Senha',
            'senha2' => 'Confirmar Senha',
        ];
    }
    
    

}
