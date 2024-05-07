<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "pessoa".
 *
 * @property int $pess_codigo
 * @property string $pess_nome
 * @property string $pess_email
 * @property string $pess_senha
 * @property string $pess_token
 * @property int $peti_codigo
 * @property string|null $pess_imagem
 * @property int $pess_habilitado
 * @property string $pess_data_criacao
 * @property string $pess_data_alteracao
 *
 * @property PessoaTipo $petiCodigo
 */
class Pessoa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

     public $data_criacao    = 'pess_data_criacao';
     public $data_alteracao  = 'pess_data_alteracao';
     public $confirm_password = "";
 
    public static function tableName()
    {
        return 'pessoa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        // @DESC strings para refinamento
        $strings = [
            'pess_nome', 'pess_email', 'pess_imagem', 'pess_token'
        ];
        return [
            [['pess_nome', 'pess_email'], 'required'],
            [['pess_data_criacao', 'pess_data_alteracao'], 'safe'],
            [['pess_habilitado', 'peti_codigo'], 'integer'],
            [['pess_nome', 'pess_email', 'pess_uuid'], 'string', 'max' => 255],
            [['pess_senha', 'pess_imagem', 'pess_token'], 'string', 'max' => 80],
            [['peti_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => PessoaTipo::className(), 'targetAttribute' => ['peti_codigo' => 'peti_codigo']],
            // my rules --------------------------------
            [['pess_habilitado'], 'integer', 'min' => 0, 'max' => 1],
            [['peti_codigo'], 'integer', 'min' => 1, 'max' => 2],
            [$strings, 'trim'],
            [$strings, 'filter', 'filter'=>'mb_strtolower'],
            // my rules --------------------------------
            [['pess_email'], 'unique'],
            [['pess_email'], 'email'],
            [["pess_senha", "confirm_password"],'required'],
            [['pess_senha', 'confirm_password'], 'string', 'min' => 6 ,'max' => 80],
            [['pess_senha'], 'compare', 'compareAttribute' => 'confirm_password'],
            // [['pess_senha', "confirm_password"],'safe'],
            // [['current_password'], 'validarData'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pess_codigo' => 'Codigo',
            'pess_nome' => 'Nome',
            'pess_email' => 'Email',
            'pess_senha' => 'Senha',
            'pess_uuid' => 'Uuid',
            'pess_token' => 'Token',
            'peti_codigo' => 'Peti Codigo',
            'pess_imagem' => 'Imagem',
            'pess_habilitado' => 'Habilitado',
            'pess_data_criacao' => 'Data Criacao',
            'pess_data_alteracao' => 'Data Alteracao',
        ];
    }

    /**
     * Gets query for [[PetiCodigo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPeti()
    {
        return $this->hasOne(PessoaTipo::className(), ['peti_codigo' => 'peti_codigo']);
    }

    // ------------------------------------------- >>>>>>>>> V2
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            # aqui gero uma hora timestamp nada mais
            $hora_edicao = new Expression('current_timestamp');

            # verifico se e insert ou update
            if($insert) { // inserir

                $this[$this->data_criacao]   = $hora_edicao;
                $this[$this->data_alteracao] = $hora_edicao;

                $this->peti_codigo = 2; // usuario

            } else { // atualizar
                $this[$this->data_alteracao] = $hora_edicao;
                
                // prevent change usuario to admin
                if ($this->getOldAttribute('peti_codigo') == 2) {
                    $this->peti_codigo = $this->getOldAttribute('peti_codigo');
                }
            }

            // @DEC block troca de senha forcada via body via parameter
            // $this->pess_email = $this->getOldAttribute('pess_email');
            // $this->pess_nome = $this->getOldAttribute('pess_nome');
            // $this->pess_senha = $this->getOldAttribute('pess_senha');

            // @DESC evitando auto disable do usuario pess_habilitado to false
            $this->pess_habilitado = 1; // sempre disponivel

            // @DESC alterando token do usuario
            $this->pess_token = Yii::$app->security->generateRandomString();
                        
            // @DESC alterando uuid do usuario
            // # GENERATE UUID
            if($this->pess_uuid == null) {
                $this->pess_uuid = \Yii::$app->Utils->gen_uuid();
            } else {
                $this->pess_uuid = $this->getOldAttribute('pess_uuid');
            }

            // @DESC removendo tags e realizando sanitizacao de parametros
            yii::$app->Utils->scapeTags($this, $this->data_criacao, $this->data_alteracao);

            //Criptografia
            if ($this->pess_senha != '') {
                $this->pess_senha = Yii::$app->security->generatePasswordHash($this->pess_senha);
            }

            // @DESC validando errors nos atrributes
            return yii::$app->Utils->verififyErrors($this);

        } else {
            return false; # retorna erro
        }
    }

    // @DESC tudo o que for de ID é preciso criptografar
    public function afterFind()
    {
        parent::afterFind();
        // @DESC removendo tags e realizando sanitizacao de parametros
        yii::$app->Utils->scapeTags($this, $this->data_criacao, $this->data_alteracao);
    }

    // @DESC isso e usado para simular o before find depois de atualizar o registro
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
    }
    // ------------------------------------------- >>>>>>>>> V2

    // public function validarData($attribute, $params)
    // {
    //     $user_hash = yii::$app->user->identity->pess_senha;

    //     if (Yii::$app->getSecurity()->validatePassword($this->current_password, $user_hash)) {
    //         // all good, logging user in
    //         // $this->addError($attribute, 'funcinocou');
    //     } else {
    //         // wrong password
    //         $this->addError($attribute, 'Senha atual inválida!');
    //     }
    // }
}
