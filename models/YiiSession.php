<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "yii_session".
 *
 * @property string $id
 * @property int $expire
 * @property resource $data
 */
class YiiSession extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'yii_session';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'expire', 'data'], 'required'],
            [['expire'], 'integer'],
            [['data'], 'string'],
            [['id'], 'string', 'max' => 40],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'expire' => 'Expire',
            'data' => 'Data',
        ];
    }
}
