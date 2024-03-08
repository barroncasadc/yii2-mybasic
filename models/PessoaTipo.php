<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pessoa_tipo".
 *
 * @property int $peti_codigo
 * @property string $peti_nome
 * @property int $peti_habilitado
 * @property string $peti_data_criacao
 * @property string $peti_data_alteracao
 *
 * @property Pessoa[] $pessoas
 */
class PessoaTipo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pessoa_tipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['peti_nome', 'peti_data_criacao', 'peti_data_alteracao'], 'required'],
            [['peti_habilitado'], 'integer'],
            [['peti_data_criacao', 'peti_data_alteracao'], 'safe'],
            [['peti_nome'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'peti_codigo' => 'Peti Codigo',
            'peti_nome' => 'Peti Nome',
            'peti_habilitado' => 'Peti Habilitado',
            'peti_data_criacao' => 'Peti Data Criacao',
            'peti_data_alteracao' => 'Peti Data Alteracao',
        ];
    }

    /**
     * Gets query for [[Pessoas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPessoas()
    {
        return $this->hasMany(Pessoa::className(), ['peti_codigo' => 'peti_codigo']);
    }
}
