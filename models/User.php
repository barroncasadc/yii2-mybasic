<?php

namespace app\models;
use Yii;

// estou dizendo que os dados que eu vou consultar para login está na tabela Usuario...
// aqui executa apenas as funções...
// que foi passada via submit atraves da janela de login e passada pelo controller pra ká..
class User extends Pessoa implements \yii\web\IdentityInterface
{
    // deve ser a primary key que ele pega...
    // cara aqui ele tá nem usando essas paradas é so porque é obrigatorio da função login
    // nao estou usando ****

    // // change senha
    public $currentPassword;
    public $newPassword;
    public $newPasswordConfirm;


    public function rules()
    {
        return [
             // change senha
            [['currentPassword', 'newPassword', 'newPasswordConfirm'], 'required'],
            [['currentPassword'], 'validateCurrentPassword'],

            [['newPassword', 'newPasswordConfirm'], 'string', 'min' => 3],
            [['newPassword', 'newPasswordConfirm'], 'filter', 'filter' => 'trim'],

            [['newPasswordConfirm'], 'compare', 'compareAttribute' => 'newPassword', 'message' => 'Senhas informadas não Coincidem...'],

            // [['senha'], 'message' => 'Senhas informadas não Coincidem...'],

        ];
    }

    public function attributeLabels()
    {
        return [
            'currentPassword' => 'Senha antiga',
            'newPassword' => 'Nova senha',
            'newPasswordConfirm' => 'Repetir senha',
        ];
    }

    public function validateCurrentPassword()
    {
        if (!$this->verifyPassword($this->currentPassword)) {
            $this->addError("currentPassword", "Senha antiga incorreta...");
        }
    }

    public function verifyPassword($senha)
    {
        $dbsenha = static::findOne(['pess_nome' => Yii::$app->user->identity->pess_nome])->pess_senha;
        return Yii::$app->security->validatePassword($senha, $dbsenha);
    }


    public static function findIdentity($pess_codigo)
    {
        return static::findOne($pess_codigo);
    }

    // ele procura por uma instância da classe de identidade usando o token de acesso informado.
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented. ');
    }

    // aqui ele procura o Usuario que tenha esse email e seja habilitado...
    public static function findByUsername($email)
    {
        // esse $email é passada pelo submit login
        return static::findOne([
            'pess_email' => $email,
            'pess_habilitado' => 1,
            'peti_codigo' => 1, // APENAS ADMIN LOGA NO SISTEMA
        ]);
    }

    // recupera o id do Usuario
    public function getId()
    {
        return $this->pess_codigo;
    }

    // recupera a auth_key do Usuario
    public function getAuthKey()
    {
        return $this->pess_token;
    }

    // retorna uma chave para verificar login via cookie.
    public function validateAuthKey($authKey)
    {
        return $this->pess_token === $authKey;
    }

    // compara se a senha passada por post é igual a senha do Usuario do banco
    public function validatePassword($senha)
    {
        return Yii::$app->security->validatePassword($senha, $this->pess_senha);
    }

    public function getNomeSolo() {
        $nome = explode(' ', yii::$app->user->identity->pess_nome);
        return "(" .$nome[0]. ")";
    }

}