<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{

    public $verifyCode;

    public $email;
    public $senha;
    public $rememberMe = true;

    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email'], 'email', 'message' => 'Informe um e-mail válido'],
            [['email', 'senha'], 'trim'],
            [['email'], 'filter', 'filter'=>'mb_strtolower'],
            [['email', 'senha'], 'filter', "filter" => function ($value) {
                return \yii\helpers\Html::encode($value);
            }],
            [['senha'], 'string', 'min' => 6, 'max' => 15, 'message' => 'Senha inválida'],
            // email and senha are both required
            [['email', 'senha'], 'required', 'message' => 'O campo não pode estar em branco'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // senha is validated by validatePassword()
            ['senha', 'validatePassword'],
            // ['verifyCode', 'captcha', 'captchaAction' => 'site/captcha']
        ];
    }

    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verificação',
        ];
    }

    /**
     * Validates the senha.
     * This method serves as the inline validation for senha.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->senha)) {
                $this->addError('email', '');
                $this->addError('senha', 'Dados não conferem.');
                // $this->addError('email', 'Dados não conferem.');
            }
        }
    }

    /**
     * Logs in a user using the provided email and senha.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        } else {
            // \Yii::$app->getSession()->setFlash('danger', 'Dados não conferem.');
        }
        return false;
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByUsername($this->email);
        }

        return $this->_user;
    }
}
