<?php

namespace app\models;


/**
 * This is the model class for table "usuario".
 *
 * @property integer $id
 * @property string $nome
 * @property string $usuario
 * @property string $senha
 * @property string $authKey
 * @property integer $ativo
 * @property integer $is_admin
 */
class Usuario extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    
    public $username;
    public $password;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nome', 'usuario', 'senha', 'authKey', 'ativo', 'is_admin'], 'required','message' => '{attribute} não pode estar em branco.'],
            [['ativo', 'is_admin'], 'integer'],
            [['nome'], 'string', 'max' => 50],
            [['usuario'], 'string', 'max' => 30],
            [['senha'], 'string', 'max' => 64],
            [['authKey'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nome' => 'Nome',
            'usuario' => 'Usuário',
            'senha' => 'Senha',
            'authKey' => 'Auth Key',
            'ativo' => 'Ativo',
            'is_admin' => 'Is Admin',
        ];
    }
    
    public function getNome(){
        return $this->nome;
    }
    
    public function isAtivo(){
        return $this->ativo;
    }
    
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;;
    }
}
