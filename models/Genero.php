<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "genero".
 *
 * @property int $gene_codigo
 * @property string $gene_uuid
 * @property string $gene_nome
 * @property int $gene_habilitado
 * @property string $gene_data_criacao
 * @property string $gene_data_alteracao
 *
 * @property Especie[] $especies
 */
class Genero extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $data_criacao    = 'gene_data_criacao';
    public $data_alteracao  = 'gene_data_alteracao';
    public static function tableName()
    {
        return 'genero';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        // @DESC strings para refinamento
        $strings = [
            'gene_uuid', 'gene_nome'
        ];
        return [
            [['gene_nome'], 'required'],
            [['gene_habilitado'], 'integer'],
            [['gene_data_criacao', 'gene_data_alteracao'], 'safe'],
            [['gene_uuid', 'gene_nome'], 'string', 'max' => 255],
            // my rules --------------------------------
            [['gene_nome'], 'unique'],
            [['gene_habilitado'], 'integer', 'min' => 0, 'max' => 1],
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
            'gene_codigo' => 'Codigo',
            'gene_uuid' => 'Uuid',
            'gene_nome' => 'Nome',
            'gene_habilitado' => 'Habilitado',
            'gene_data_criacao' => 'Data Criacao',
            'gene_data_alteracao' => 'Data Alteracao',
        ];
    }

    /**
     * Gets query for [[Especies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEspecies()
    {
        return $this->hasMany(Especie::className(), ['gene_codigo' => 'gene_codigo']);
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

            // @DESC evitando auto disable do usuario gene_habilitado to false
            // $this->gene_habilitado = 1; // sempre disponivel

            // @DESC alterando uuid do usuario
            // # GENERATE UUID
            if($this->gene_uuid == null) {
                $this->gene_uuid = \Yii::$app->Utils->gen_uuid();
            } else {
                $this->gene_uuid = $this->getOldAttribute('gene_uuid');
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
