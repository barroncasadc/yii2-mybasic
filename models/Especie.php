<?php

namespace app\models;

use Yii;
use yii\db\Expression;


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

    public $data_criacao    = 'espe_data_criacao';
    public $data_alteracao  = 'espe_data_alteracao';

    public static function tableName()
    {
        return 'especie';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        // @DESC strings para refinamento
        $strings = [
            'espe_uuid', 'espe_nome', 'espe_imagem'
        ];
        return [
            [['espe_nome', 'fami_codigo', 'gene_codigo'], 'required'],
            [['fami_codigo', 'gene_codigo', 'espe_habilitado'], 'integer'],
            [['espe_data_criacao', 'espe_data_alteracao'], 'safe'],
            [['espe_uuid', 'espe_nome', 'espe_imagem'], 'string', 'max' => 255],
            [['fami_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Familia::className(), 'targetAttribute' => ['fami_codigo' => 'fami_codigo']],
            [['gene_codigo'], 'exist', 'skipOnError' => true, 'targetClass' => Genero::className(), 'targetAttribute' => ['gene_codigo' => 'gene_codigo']],
            // my rules --------------------------------
            [['espe_nome'], 'unique'],
            [['espe_habilitado'], 'integer', 'min' => 0, 'max' => 1],
            [$strings, 'trim'],
            [$strings, 'filter', 'filter'=>'mb_strtolower'],
            // my rules --------------------------------
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'espe_codigo' => 'Codigo',
            'espe_uuid' => 'Uuid',
            'espe_nome' => 'Nome',
            'espe_imagem' => 'Imagem',
            'fami_codigo' => 'Fami Codigo',
            'gene_codigo' => 'Gene Codigo',
            'espe_habilitado' => 'Habilitado',
            'espe_data_criacao' => 'Data Criacao',
            'espe_data_alteracao' => 'Data Alteracao',
        ];
    }

    /**
     * Gets query for [[FamiCodigo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFamilia()
    {
        return $this->hasOne(Familia::className(), ['fami_codigo' => 'fami_codigo']);
    }

    /**
     * Gets query for [[GeneCodigo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenero()
    {
        return $this->hasOne(Genero::className(), ['gene_codigo' => 'gene_codigo']);
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

            } else { // atualizar
                $this[$this->data_alteracao] = $hora_edicao;
            }

            // @DESC evitando auto disable do usuario fami_habilitado to false
            // $this->fami_habilitado = 1; // sempre disponivel

            // @DESC alterando uuid do usuario
            // # GENERATE UUID
            if($this->espe_uuid == null) {
                $this->espe_uuid = \Yii::$app->Utils->gen_uuid();
            } else {
                $this->espe_uuid = $this->getOldAttribute('espe_uuid');
            }
                        
            // @DESC removendo tags e realizando sanitizacao de parametros
            yii::$app->Utils->scapeTags($this, $this->data_criacao, $this->data_alteracao);

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
}
