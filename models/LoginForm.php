<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 */
class LoginForm extends Model {

    public $usuario;
    public $senha;
    public $rememberMe = true;
    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            // username and password are both required
            [['usuario', 'senha'], 'required', 'message' => '*Campo obrigatório'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['senha', 'validatePassword'],
        ];
    }

    public function attributeLabels() {
        return ['usuario' => 'Usuário',
            'senha' => 'Senha',
            'rememberMe' => 'Manter Logado'
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params) {
        if (!$this->hasErrors()) {
            
            $user = $this->getUser();
//            var_dump($user);
            
            if ($user != null) {
//                $dbpass = $user->senha;
//                $formsenha = md5($this->senha);

                if (!$user || !Yii::$app->getSecurity()->validatePassword($this->senha, $user->senha)) {
                    $this->addError($attribute, 'Senha ou Usuário Incorretos.');
                }elseif(!$user->isAtivo()){
                    $this->addError($attribute, 'Este usuário foi desativado e não pode mais acessar o sistema.');
                }
            } else {
                $this->addError($attribute, 'Senha ou Usuário Incorretos.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login() {
        if ($this->validate()) {
            return Yii::$app->user->login($this->_user, $this->rememberMe ? 3600 * 24 * 30 : 0);
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser() {
        if ($this->_user === false) {
            $this->_user = Usuario::find()->where(['usuario' => $this->usuario])->one();
            if($this->_user != null){
            $this->_user->username = $this->_user->usuario;
            $this->_user->password = $this->_user->senha;
            }
//            $this->_user = User::findByUsername($this->usuario);
        }

        return $this->_user;
    }

}
