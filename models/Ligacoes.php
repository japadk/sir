<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ligacoes".
 *
 * @property integer $id
 * @property integer $id_usuario
 * @property string $data
 * @property string $horario
 * @property string $ddd
 * @property string $telefone
 * @property string $cnpj
 * @property string $rasao_social
 * @property string $responsavel
 * @property string $email
 * @property string $status
 * @property string $data_retorno
 * @property string $horario_retorno
 *  * @property string $observacoes
 * @property string $retorno 
 */
class Ligacoes extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ligacoes';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_usuario', 'data', 'horario', 'ddd', 'telefone', 'cnpj', 'rasao_social', 'responsavel', 'email', 'status'], 'required','message'=>'{attribute} não pode estar em branco.'],
            [['id_usuario'], 'integer'],
            [['data', 'horario','data_retorno','horario_retorno'], 'safe'],
            [['observacoes'], 'string'],
            [['ddd'], 'string', 'max' => 2],
            [['telefone'], 'string', 'max' => 10],
            [['cnpj'], 'string', 'max' => 20],
            [['rasao_social'], 'string', 'max' => 100],
            [['responsavel'], 'string', 'max' => 30],
            [['email'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_usuario' => 'Id Usuário',
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
            'observacoes' => 'Observações',
            'retorno' => 'Retorno de',
        ];
    }
    
    public function getUsuario()
    {
        // Customer has_many Order via Order.customer_id -> id
        return $this->hasOne(Usuario::className(), ['id' => 'id_usuario']);
    }
    
    public function getSupervisa(){
        return $this->hasOne(Supervisa::className(), ['id_supervisa' => 'id_usuario']);
    }
}
