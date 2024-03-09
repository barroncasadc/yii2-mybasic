<?php

namespace app\models;

use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "familia".
 *
 * @property int $fami_codigo
 * @property string $fami_uuid
 * @property string $fami_nome
 * @property int $fami_habilitado
 * @property string $fami_data_criacao
 * @property string $fami_data_alteracao
 *
 * @property Especie[] $especies
 */
class Familia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */

    public $data_criacao    = 'fami_data_criacao';
    public $data_alteracao  = 'fami_data_alteracao';
     
    public static function tableName()
    {
        return 'familia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        // @DESC strings para refinamento
        $strings = [
            'fami_nome'
        ];
        return [
            [['fami_nome'], 'required'],
            [['fami_habilitado'], 'integer'],
            [['fami_data_criacao', 'fami_data_alteracao'], 'safe'],
            [['fami_uuid', 'fami_nome'], 'string', 'max' => 255],
            // my rules --------------------------------
            [['fami_habilitado'], 'integer', 'min' => 0, 'max' => 1],
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
            'fami_codigo' => 'Codigo',
            'fami_uuid' => 'Uuid',
            'fami_nome' => 'Nome',
            'fami_habilitado' => 'Habilitado',
            'fami_data_criacao' => 'Data Criacao',
            'fami_data_alteracao' => 'Data Alteracao',
        ];
    }

    /**
     * Gets query for [[Especies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEspecies()
    {
        return $this->hasMany(Especie::className(), ['fami_codigo' => 'fami_codigo']);
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
            if($this->fami_uuid == null) {
                $this->fami_uuid = \Yii::$app->Utils->gen_uuid();
            } else {
                $this->fami_uuid = $this->getOldAttribute('fami_uuid');
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
