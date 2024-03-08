<?php

namespace app\models;

use Yii;

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
    public static function tableName()
    {
        return 'pessoa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pess_nome', 'pess_email', 'pess_senha', 'pess_token', 'peti_codigo', 'pess_data_criacao', 'pess_data_alteracao'], 'required'],
            [['peti_codigo', 'pess_habilitado'], 'integer'],
            [['pess_data_criacao', 'pess_data_alteracao'], 'safe'],
            [['pess_nome', 'pess_email'], 'string', 'max' => 255],
            [['pess_senha', 'pess_token', 'pess_imagem'], 'string', 'max' => 80],
            [['peti_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => PessoaTipo::className(), 'targetAttribute' => ['peti_codigo' => 'peti_codigo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pess_codigo' => 'Pess Codigo',
            'pess_nome' => 'Pess Nome',
            'pess_email' => 'Pess Email',
            'pess_senha' => 'Pess Senha',
            'pess_token' => 'Pess Token',
            'peti_codigo' => 'Peti Codigo',
            'pess_imagem' => 'Pess Imagem',
            'pess_habilitado' => 'Pess Habilitado',
            'pess_data_criacao' => 'Pess Data Criacao',
            'pess_data_alteracao' => 'Pess Data Alteracao',
        ];
    }

    /**
     * Gets query for [[PetiCodigo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPetiCodigo()
    {
        return $this->hasOne(PessoaTipo::className(), ['peti_codigo' => 'peti_codigo']);
    }
}
