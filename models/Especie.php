<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "especie".
 *
 * @property int $espe_codigo
 * @property string $espe_uuid
 * @property string $espe_nome
 * @property int $fami_codigo
 * @property int $gene_codigo
 * @property int $espe_habilitado
 * @property string $espe_data_criacao
 * @property string $espe_data_alteracao
 *
 * @property Familia $famiCodigo
 * @property Genero $geneCodigo
 */
class Especie extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'especie';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['espe_uuid', 'espe_nome', 'fami_codigo', 'gene_codigo', 'espe_data_criacao', 'espe_data_alteracao'], 'required'],
            [['fami_codigo', 'gene_codigo', 'espe_habilitado'], 'integer'],
            [['espe_data_criacao', 'espe_data_alteracao'], 'safe'],
            [['espe_uuid', 'espe_nome'], 'string', 'max' => 255],
            [['fami_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Familia::className(), 'targetAttribute' => ['fami_codigo' => 'fami_codigo']],
            [['gene_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Genero::className(), 'targetAttribute' => ['gene_codigo' => 'gene_codigo']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'espe_codigo' => 'Espe Codigo',
            'espe_uuid' => 'Espe Uuid',
            'espe_nome' => 'Espe Nome',
            'fami_codigo' => 'Fami Codigo',
            'gene_codigo' => 'Gene Codigo',
            'espe_habilitado' => 'Espe Habilitado',
            'espe_data_criacao' => 'Espe Data Criacao',
            'espe_data_alteracao' => 'Espe Data Alteracao',
        ];
    }

    /**
     * Gets query for [[FamiCodigo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamiCodigo()
    {
        return $this->hasOne(Familia::className(), ['fami_codigo' => 'fami_codigo']);
    }

    /**
     * Gets query for [[GeneCodigo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGeneCodigo()
    {
        return $this->hasOne(Genero::className(), ['gene_codigo' => 'gene_codigo']);
    }
}
